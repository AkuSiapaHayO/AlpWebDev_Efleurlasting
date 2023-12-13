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

    public function adminindex() {
        return view('Admin.Product.view', [
            'products' => Product::all(),
            'categories' => Category::all(),
        ]);
    }

    public function adminshow(Product $product) {

        $product->load('category');

        $productColors = $product->productColors;
        $images = $product->images;

        return view ('Admin.Product.show', [
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
