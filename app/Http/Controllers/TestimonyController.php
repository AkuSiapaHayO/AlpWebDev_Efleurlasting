<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
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

    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Images
            if ($request->hasFile('product_image')) {
                $imagePath = $request->file('product_image')->store('user', ['disk' => 'public']);

                Testimony::create([
                    'testimony' => $request->input('testimony'),
                    'testimony_image' => $imagePath,
                    'name' => $request->user()->username,
                    'date' => now(),
                    'user_id' => auth()->id(),
                    'product_id' => $request->input('product'),
                ]);
            }

            return redirect()->route('home');
        } catch (\Exception $e) {
            dd($e->getMessage(), $request->all());
        }
    }


    // Web Code
    // $image = $request->file('product_image');
    // $imagePath = 'Testimony/' . time() . '.' . $image->getClientOriginalExtension();
    // $image->storeAs('public', $imagePath);

    /**
     * Display the specified resource.
     */
    public function show(Testimony $testimony)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimony $testimony)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimony $testimony)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimony $testimony)
    {
        //
    }
}
