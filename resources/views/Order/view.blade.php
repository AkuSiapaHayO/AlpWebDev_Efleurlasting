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

                    <h4>Order Items</h4>
                    <ul>

                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection
