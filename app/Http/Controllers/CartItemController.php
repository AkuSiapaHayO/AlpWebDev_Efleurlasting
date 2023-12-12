<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function addToCart(array $data)
    {
        $user = auth()->user();
        $cart = $user->cart;

        return CartItem::create([
            'quantity' => $data['username'],
            'cart_id' => $cart,
            'productcolor_id' => $data['productColor'],
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

        $user = Auth::user();
        $cart = $user->cart;

        CartItem::create([
            'quantity' => $request->quantity,
            'cart_id' => $cart->id,
            'productcolor_id' => $request->productcolor,
        ]);

        return redirect()->route('cart')->with('success', 'Product added to cart successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem)
    {
        //
    }
}
