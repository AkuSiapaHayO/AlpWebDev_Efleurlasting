<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Products.view', [
            'products' => Product::all(),
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
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data, including the file upload
        $request->validate([
            // ... your existing validation rules ...
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the allowed file types and size
        ]);

        // Store the uploaded image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user', ['disk' => 'public']);
            // You can save the image path and associate it with the product
            $product = Product::create([
                'product_name' => $request->input('product_name'),
                'description' => $request->input('description'),
                'size' => $request->input('size'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category_id'),
            ]);

            $product->images()->create([
                'image_name' => $imagePath,
                'product_id' => $product->id,
            ]);
        } else {
            Product::create([
                'product_name' => $request->input('product_name'),
                'description' => $request->input('description'),
                'size' => $request->input('size'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category_id'),
            ]);
        }

        return redirect()->route('products.view')->with('success', 'New Product Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
