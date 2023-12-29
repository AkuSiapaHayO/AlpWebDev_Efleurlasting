<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;
use App\Models\OrderItem;

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
        $validatedData = $request->validate([
            'product_image' => 'required|image',
        ]);

        if ($request->file('product_image')) {
            $image = $validatedData['product_image'];
            $imageName = 'Testimony/' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Testimony'), $imageName);
        }

        $orderItemId = $request->input('orderitem_id');
        $orderItem = OrderItem::with('productColor')->find($orderItemId);
        $productColorId = $orderItem->productColor->id;

        Testimony::create([
            'testimony' => $request->input('testimony'),
            'testimony_image' => $imageName,
            'name' => $request->user()->username,
            'date' => now(),
            'user_id' => auth()->id(),
            'productcolor_id' => $productColorId,
        ]);

        return redirect()->route('home');
    }

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
