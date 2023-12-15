<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Products.view', [
            'products' => Product::where('is_active', true)->get(),
            'categories' => Category::all(),
        ]);
    }

    public function adminindex()
    {
        return view('Admin.Product.view', [
            'products' => Product::all(),
            'categories' => Category::all(),
        ]);
    }

    public function adminshow(Product $product)
    {

        $product->load('category');

        $productColors = $product->productColors;
        $images = $product->images;

        return view('Admin.Product.show', [
            'product' => $product,
            'category' => $product->category,
            'productColors' => $productColors,
            'images' => $images,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Product.create', [
            'categories' => Category::all(),
            'colors' => Color::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'image',
        ]);

        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'size' => $request->input('size'),
            'price' => $request->input('price'),
            'is_active' => true,
            'category_id' => $request->input('category_id'),
        ]);

        // Existing Colors
        if ($request->has('selected_colors')) {
            foreach ($request->input('selected_colors') as $colorId) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'color_id' => $colorId,
                ]);
            }
        }

        // New Colors
        if ($request->has('additional_newcolors')) {
            foreach ($request->input('additional_newcolors') as $color) {
                if (!is_null($color)) {
                    $colorModal = Color::create(['color_name' => $color]);
                    ProductColor::create([
                        'product_id' => $product->id,
                        'color_id' => $colorModal->id
                    ]);
                }
            }
        }

        // Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('user', ['disk' => 'public']);

                $product->images()->create([
                    'image_name' => $imagePath,
                    'product_id' => $product->id,
                ]);
            }
        }

        return redirect()->route('products.view', ['product' => $product->id])->with('success', 'New Product Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        $productColors = $product->productColors;
        $images = $product->images;

        return view('Products.show', [
            'product' => $product,
            'category' => $product->category,
            'productColors' => $productColors,
            'images' => $images,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $productColors = $product->productColors;
        $images = $product->images;
        $checkedColors = $productColors->pluck('color_id')->toArray();
        return view('Admin.Product.edit', [
            'product' => $product,
            'category' => $product->category,
            'productColors' => $productColors,
            'images' => $images,
            'categories' => Category::all(),
            'colors' => Color::all(),
            'checkedColors' => $checkedColors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'images.*' => 'image',
        ]);

        $updateData = [];

        if ($request->filled('product_name')) {
            $updateData['product_name'] = $request->input('product_name');
        }

        if ($request->filled('description')) {
            $updateData['description'] = $request->input('description');
        }

        if ($request->filled('size')) {
            $updateData['size'] = $request->input('size');
        }

        if ($request->filled('price')) {
            $updateData['price'] = $request->input('price');
        }

        if ($request->filled('category_id')) {
            $updateData['category_id'] = $request->input('category_id');
        }

        // Existing Colors
        $selectedColorIds = $request->input('selected_colors', []);

        // Check and create ProductColor entries
        foreach ($selectedColorIds as $colorId) {
            // Check if ProductColor with the same product_id and color_id already exists
            $existingProductColor = ProductColor::where('product_id', $product->id)
                ->where('color_id', $colorId)
                ->first();

            // If not, create a new ProductColor entry
            if (!$existingProductColor) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'color_id' => $colorId,
                ]);
            }
        }

        // Delete ProductColor entries with color_id not in selected colors
        ProductColor::where('product_id', $product->id)
            ->whereNotIn('color_id', $selectedColorIds)
            ->delete();


        // New Colors
        if ($request->has('additional_newcolors')) {
            foreach ($request->input('additional_newcolors') as $color) {
                $colorModel = Color::create(['color_name' => $color]);

                $product->colors()->attach($colorModel->id);
            }
        }

        // Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('user', ['disk' => 'public']);

                $product->images()->create([
                    'image_name' => $imagePath,
                    'product_id' => $product->id,
                ]);
            }
        }

        return redirect()->route('products.show', ['product' => $product->id])->with('success', 'Product Updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
