<!-- resources/views/orders/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Your Orders</h2>

        @foreach ($orders as $order)
            <div class="card mb-3">
                <div class="card-header">
                    Order ID: {{ $order->id }}
                    <!-- Add other order details as needed -->
                </div>
                <div class="card-body">
                    <p>Total Amount: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    <p>Order Date: {{ $order->order_date }}</p>
                    <p>Delivery Date: {{ $order->delivery_date }}</p>
                    <!-- Add other order details as needed -->

                    <h4>Order Items</h4>
                    <ul>
                        @foreach ($order->orderItems as $orderItem)
                            <li>
                                Product: {{ $orderItem->productColor->product->category->category_name }}
                                         - {{ $orderItem->productColor->product->product_name }}
                                         (Color: {{ $orderItem->productColor->color->color_name }})
                                Quantity: {{ $orderItem->quantity }}
                                Note: {{ $orderItem->note }}
                                <!-- Add other order item details as needed -->
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection
