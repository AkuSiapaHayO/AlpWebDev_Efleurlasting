<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        $categories = Category::all();

        return view('Admin.Category.view', compact('categories'));
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

        if ($request->file('category_image')) {
            $image = $validatedData['category_image'];
            $imageName = 'Category/' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Category'), $imageName);
        }

        Category::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
            'category_image' => $imageName,
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

        return view('Category.show', compact('category', 'products'));
    }

    public function adminshow(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();

        return view('Admin.Category.show', compact('category', 'products'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('Admin.Category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_image' => 'nullable|image',
        ]);

        $category->update([
            'category_name' => $validatedData['category_name'],
            'description' => $validatedData['description'],
        ]);

        if ($request->hasFile('category_image')) {

            if ($category->category_image) {
                $originalImagePath = public_path($category->category_image);
                if (File::exists($originalImagePath)) {
                    File::delete($originalImagePath);
                }
            }

            $image = $validatedData['category_image'];
            $imageName = 'Category/' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Category'), $imageName);

            $category->update([
                'category_image' => $imageName
            ]);
        }

        return redirect()->route('admin.categories.view')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->category_image) {
            $originalImagePath = public_path($category->category_image);
            if (File::exists($originalImagePath)) {
                File::delete($originalImagePath);
            }
        }

        $category->products()->delete();
        $category->delete();

        return redirect()->route('admin.categories.view')->with('success', 'Category deleted successfully');
    }
}
