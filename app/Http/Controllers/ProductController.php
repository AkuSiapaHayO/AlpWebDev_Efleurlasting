<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        if ($request->has('search')) {
            $products = Product::where('product_name', 'like', '%' . $request->search . '%')->where('is_active', true)->paginate(15)->withQueryString();
        } else {
            $products = Product::where('is_active', true)->paginate(15);
        }

        return view('Products.view', compact('categories', 'products'));
    }

    public function adminindex()
    {
        $products = Product::all();
        $categories = Category::all();

        return view('Admin.Product.view', compact('products', 'categories'));
    }

    public function adminshow(Product $product)
    {
        $product->load('category');
        $productColors = $product->productColors;
        $category = $product->category;
        $images = $product->images;

        return view('Admin.Product.show', compact('product', 'productColors', 'category', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();

        return view('Admin.Product.create', compact('categories', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'image',
        ]);

        $is_active = $request->has('is_active') && $request->input('is_active') === 'on';

        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'size' => $request->input('size'),
            'price' => $request->input('price'),
            'is_active' => $is_active,
            'category_id' => $request->input('category_id'),
        ]);

        if ($request->has('selected_colors')) {
            foreach ($request->input('selected_colors') as $colorId) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'color_id' => $colorId,
                ]);
            }
        }

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

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = 'Products/' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Products'), $imageName);

                $product->images()->create([
                    'image_name' => $imageName,
                    'product_id' => $product->id,
                ]);
            }
        }

        return redirect()->route('products.show', ['product' => $product->id])->with('success', 'New Product Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        $productColors = $product->productColors;
        $images = $product->images;
        $category = $product->category;

        return view('Products.show', compact('product', 'category', 'images', 'productColors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $category = $product->category;
        $productColors = $product->productColors;
        $images = $product->images;
        $categories = Category::all();
        $colors = Color::all();
        $checkedColors = $productColors->pluck('color_id')->toArray();
        return view('Admin.Product.edit', compact('product', 'category', 'productColors', 'images', 'categories', 'colors', 'checkedColors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $is_active = $request->has('is_active') && $request->input('is_active') === 'on';

        $product->update([
            'product_name' => $request->filled('product_name') ? $request->input('product_name') : $product->product_name,
            'description' => $request->filled('description') ? $request->input('description') : $product->description,
            'size' => $request->filled('size') ? $request->input('size') : $product->size,
            'price' => $request->filled('price') ? $request->input('price') : $product->price,
            'is_active' => $is_active,
            'category_id' => $request->filled('category_id') ? $request->input('category_id') : $product->category_id,
        ]);

        $selectedColorIds = $request->input('selected_colors', []);

        foreach ($selectedColorIds as $colorId) {
            $existingProductColor = ProductColor::where('product_id', $product->id)
                ->where('color_id', $colorId)
                ->first();

            if (!$existingProductColor) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'color_id' => $colorId,
                ]);
            }
        }

        ProductColor::where('product_id', $product->id)
            ->whereNotIn('color_id', $selectedColorIds)
            ->delete();

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
        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $image) {
        //         $imagePath = $image->store('user', ['disk' => 'public']);

        //         $product->images()->create([
        //             'image_name' => $imagePath,
        //             'product_id' => $product->id,
        //         ]);
        //     }
        // }

        return redirect()->route('products.show', ['product' => $product->id])->with('success', 'Product Updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        // Delete Images
        $images = $product->images;

        foreach ($images as $image) {
            if (File::exists(public_path($image->image_name))) {
                File::delete(public_path($image->image_name));
            }

            $image->delete();
        }

        // CartItem & ProductColor delete
        foreach ($product->productColors as $productColor) {
            $cartItem = $productColor->cartitem;

            if ($cartItem) {
                $cartItem->delete();
            }

            $productColor->delete();
        }

        // Delete Product
        $product->delete();

        return redirect()->route('products.view')->with('success', 'Product Deleted');
    }
}
