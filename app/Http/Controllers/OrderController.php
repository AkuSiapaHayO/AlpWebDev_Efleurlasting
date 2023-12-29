<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        return view('Order.view', [
            'user' => $user,
            'orders' => $orders
        ]);
    }

    public function adminindex()
    {
        $orders = Order::where('payment_status', true)->get();

        return view('Admin.Order.view', [
            'orders' => $orders,
        ]);
    }

    public function paymentindex()
    {
        $orders = Order::where('payment_status', false)->get();

        return view('Admin.Payment.view', [
            'orders' => $orders,
        ]);
    }

    public function paymentshow(Order $order)
    {
        return view('Admin.Payment.show', [
            'order' => $order,
        ]);
    }

    public function paymentapprove(Order $order)
    {
        $order->update([
            'payment_status' => true,
        ]);

        return redirect()->route('payment.view')->with('success', 'Payment Approved!');
    }

    public function paymentdisapprove(Order $order)
    {
        $order->delete();
        return redirect()->route('payment.view')->with('success', 'Order Deleted');
    }

    public function orderfinish(Order $order)
    {
        $order->update([
            'delivery_status' =>true,
        ]);

        return redirect()->route('orders.view')->with('success', 'Order Approved');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;
        $cartItemsId = $request->input('selectedCartItems', []);
        $cartItems = CartItem::whereIn('id', $cartItemsId)->get();

        return view('Order.create', [
            'cart' => $cart,
            'cartItems' => $cartItems,
            'cartItemsId' => $cartItemsId,
            'user' => $user,
        ]);
    }

    public function finalize(Request $request)
    {
        // Retrieve user, cart, and cart items
        $user = Auth::user();
        $cart = $user->cart;
        $cartItemsId = explode(',', $request->input('cartItemId'));
        $cartItems = CartItem::whereIn('id', $cartItemsId)->get();

        // Get form data
        $deliveryDate = $request->input('delivery_date');
        $deliveryTime = $request->input('delivery_time');
        $recipientName = $request->input('recipient_name');
        $recipientPhone = $request->input('recipient_phone');
        $recipientAddress = $request->input('recipient_address');
        $notes = $request->input('notes');
        // $isDelivery = ($request->input('deliveryOption') == 1);
        $isDelivery = ($request->input('deliveryOption') == "0") ? false : true;
        $totalAmountBeforeDelivery = $request->input('totalAmount');

        $deliveryFee = 0;

        if ($isDelivery == true) {
            $deliveryFee = 25000;
            $totalAmount = $totalAmountBeforeDelivery + $deliveryFee;
            $boolIsDelivery = true;
        } else {
            $totalAmount = $totalAmountBeforeDelivery;
            $boolIsDelivery = false;
        }


        // Pass form data to the view
        return view('Order.finalize', [
            'cart' => $cart,
            'cartItems' => $cartItems,
            'user' => $user,
            'deliveryDate' => $deliveryDate,
            'deliveryTime' => $deliveryTime,
            'recipientName' => $recipientName,
            'recipientPhone' => $recipientPhone,
            'recipientAddress' => $recipientAddress,
            'notes' => $notes,
            'isDelivery' => $boolIsDelivery,
            'deliveryFee' => $deliveryFee,
            'totalAmountBeforeDelivery' => $totalAmountBeforeDelivery,
            'totalAmount' => $totalAmount,
            'cartItemsId' => $cartItemsId,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        $user = Auth::user();
        $cartItemsId = explode(',', $request->input('cartItemId'));
        $cartItems = CartItem::whereIn('id', $cartItemsId)->get();
        $isDelivery = $request->input('isDelivery') ?? true;

        $validatedDate = $request->validate([
            'paymentDetails' => 'required|string',
            'uploadImage' => 'required|image',
        ]);

        if ($request->file('uploadImage')) {
            $image = $validatedDate['uploadImage'];
            $imageName = 'Transfer/' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Transfer'), $imageName);
        }

        $order = Order::create([
            'payment_details' => $validatedDate['paymentDetails'],
            'order_date' => now(),
            'total_amount' => $request->input('total_amount'),
            'delivery_date' => $request->input('delivery_date'),
            'delivery_time' => $request->input('delivery_time'),
            'recipient_name' => $request->input('recipient_name'),
            'recipient_phone' => $request->input('recipient_phone'),
            'recipient_address' => $request->input('recipient_address'),
            'notes' => $request->input('notes'),
            'isDelivery' => $isDelivery,
            'payment_status' => false,
            'delivery_status' => false,
            'user_id' => $user->id,
            'transfer_evidence_img' => $imageName,
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'quantity' => $cartItem->quantity,
                'note' => $cartItem->note,
                'order_id' => $order->id,
                'productcolor_id' => $cartItem->productcolor_id,
            ]);

            $cartItem->delete();
        }

        return redirect()->route('order.view');
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
}


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
