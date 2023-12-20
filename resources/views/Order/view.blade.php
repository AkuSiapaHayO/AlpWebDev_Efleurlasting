<!-- resources/views/orders/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <div class="card my-5 shadow-lg" style="border: none;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <a href="{{ route('user.setting') }}"><button class="btn btn-pink-color fw-bold text-white">Back</button></a>
                <h1 class="heading mb-0 mx-auto">Order History</h1>
            </div>
        </div>
        @foreach ($orders as $order)
            <div class="card mb-3 shadow-lg p-3" style="border: none;">
                <div class="card-body">
                    <p class="text-secondary fw-bold text-uppercase">Order ID<span class="ms-4">{{ $order->id }}</span></p>
                    <p class="text-secondary fw-bold mb-0 text-uppercase">Total Amount</p>
                    <p class="fw-medium">{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    <p class="text-secondary fw-bold mb-0 text-uppercase">Order Date</p>
                    <p class="fw-medium">{{ $order->order_date }}</p>
                    <p class="text-secondary fw-bold mb-0 text-uppercase">Delivery Date</p>
                    <p class="fw-medium">{{ $order->delivery_date }}</p>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Color</th>
                                    <th>Quantity</th>
                                    <th>Note</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalAmount = 0;
                                @endphp
                                @foreach ($order->orderItems as $orderItem)
                                    @php
                                        $productColor = \App\Models\ProductColor::find($orderItem->productcolor_id);
                                        $product = $productColor->product;
                                        $color = $productColor->color;
                                        $category = $product->category;
                                        $subtotal = $orderItem->quantity * $productColor->product->price;
                                        $totalAmount += $subtotal;
                                    @endphp
                                    <tr>
                                        <td style="white-space: nowrap;">{{ $category->category_name }} -
                                            {{ $product->product_name }}</td>
                                        <td style="white-space: nowrap;">{{ $color->color_name }}</td>
                                        <td style="white-space: nowrap;">{{ $orderItem->quantity }}</td>
                                        <td style="white-space: nowrap;">{{ $orderItem->note }}</td>
                                        <td style="white-space: nowrap;">
                                            {{ 'Rp' . number_format($productColor->product->price, 0, ',', '.') }}</td>
                                        <td style="white-space: nowrap;">
                                            {{ 'Rp' . number_format($totalAmount, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
