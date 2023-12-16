<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function adminindex()
    {
        return view('Admin.Category.view', [
            'categories' => Category::all(),
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
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:225',
            'description' => 'required|string|max:225',
            'category_image' => 'required|image',
        ]);

        $validatedData['category_image'] = $request->file('category_image')->store('category', 'public');

        Category::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
            'category_image' => $validatedData['category_image'],
        ]);

        return redirect()->route('admin.categories.view')->with('success', 'New Category Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $products = Product::where('is_active', true)
            ->where('category_id', $category->id)
            ->get();

        return view('Category.show', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    public function adminshow(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();

        return view('Admin.Category.show', [
            'category' => $category,
            'products' => $products,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('Admin.Category.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_image' => 'nullable|image', // Make the image field optional
        ]);

        // Update category data
        $category->update([
            'category_name' => $request->input('category_name'),
            'description' => $request->input('description'),
        ]);

        // Check if a new image is provided
        if ($request->hasFile('category_image')) {

            if ($category->category_image && Storage::disk('public')->exists($category->category_image)) {
                Storage::disk('public')->delete($category->category_image);
            }

            $category->category_image = $request->file('category_image')->store('category', 'public');
            $category->save();
        }

        return redirect()->route('admin.categories.view')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->category_image && Storage::disk('public')->exists($category->category_image)) {
            // Delete the old image
            Storage::disk('public')->delete($category->category_image);
        }

        $category->products()->delete();
        $category->delete();

        return redirect()->route('admin.categories.view')->with('success', 'Category deleted successfully');
    }
}
