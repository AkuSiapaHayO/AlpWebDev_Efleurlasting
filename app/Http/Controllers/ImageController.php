<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Product $product)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = 'Product/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Product'), $imageName);

                $product->images()->create([
                    'image_name' => $imageName,
                    'product_id' => $product->id,
                ]);
            }
        }
        
        return redirect()->route('products.edit', ['product' => $product->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $product = $image->product;

        if (File::exists(public_path($image->image_name))) {
            File::delete(public_path($image->image_name));
        }

        $image->delete();

        return redirect()->route('products.edit', ['product' => $product->id]);
    }
}
