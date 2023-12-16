<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
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

        // Check if the image exists in storage
        if (Storage::disk('public')->exists($image->image_name)) {
            // Delete the image from storage
            Storage::disk('public')->delete($image->image_name);
        }

        $image->delete();
        return redirect()->route('products.edit', ['product' => $product->id]);
    }
}
