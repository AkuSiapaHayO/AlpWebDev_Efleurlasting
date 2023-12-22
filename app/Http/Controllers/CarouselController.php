<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCarouselRequest;
use App\Http\Requests\UpdateCarouselRequest;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carousels = Carousel::all();

        return view('Admin.Carousel.view', compact('carousels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:225',
            'description' => 'required|string|max:225',
            'carousel-image' => 'required|image',
        ]);

        if ($request->file('carousel-image')) {
            $image = $validatedData['carousel-image'];
            $imageName = 'Carousel/' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Carousel'), $imageName);

            Carousel::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'image' => $imageName,
            ]);

            return redirect()->route('carousel.view');
        }

        return redirect()->route('carousel.view');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carousel $carousel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carousel $carousel)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carousel $carousel)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:225'],
            'description' => ['required', 'string', 'max:225'],
        ]);

        $carousel->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description']
        ]);

        return redirect()->route('carousel.view');
    }

    public function updateImage(Request $request, Carousel $carousel)
    {
        $validatedData = $request->validate([
            'carousel-image' => ['required', 'image']
        ]);

        if ($request->file('carousel-image')) {
            if ($carousel->image) {
                $originalImagePath = public_path($carousel->image);
                if (File::exists($originalImagePath)) {
                    File::delete($originalImagePath);
                }
            }
        }

        $image = $validatedData['carousel-image'];
        $imageName = 'Carousel/' . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('Carousel'), $imageName);

        $carousel->update([
            'image' => $imageName,
        ]);

        return redirect()->route('carousel.view');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carousel $carousel)
    {
        if ($carousel->image) {
            $originalImagePath = public_path($carousel->image);
            if (File::exists($originalImagePath)) {
                File::delete($originalImagePath);
            }
        }
        $carousel->delete();
        
        return redirect()->route('carousel.view');
    }
}
