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
            <div class="card mb-3 shadow-lg p-0 p-lg-3" style="border: none;">
                <div class="card-body">
                    <p class="text-secondary fw-bold text-uppercase">Order #<span>{{ $order->id }}</span>
                    </p>
                    <p class="text-secondary fw-bold mb-0 text-uppercase">Total Amount</p>
                    <p class="fw-medium">{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    <p class="text-secondary fw-bold mb-0 text-uppercase">Order Date</p>
                    <p class="fw-medium">{{ $order->order_date }}</p>
                    <p class="text-secondary fw-bold mb-0 text-uppercase">Delivery Date</p>
                    <p class="fw-medium">{{ $order->delivery_date }}</p>
                    <p class="haeding text-secondary fw-bold mb-0 text-uppercase borders-left">Order Items</p>

                    @php
                        $totalAmount = 0;
                    @endphp
                    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 mt-3">
                        @foreach ($order->orderItems as $orderItem)
                            @php
                                $productColor = \App\Models\ProductColor::find($orderItem->productcolor_id);
                                $product = $productColor->product;
                                $color = $productColor->color;
                                $category = $product->category;
                                $subtotal = $orderItem->quantity * $productColor->product->price;
                                $totalAmount += $subtotal;
                            @endphp
                            <div class="col mb-3">
                                <div class="card shadow-lg h-100" style="border: none;">
                                    <div class="card-body">
                                        <div class="position-relative">
                                            @if ($product->images->isNotEmpty() && Storage::disk('public')->exists($product->images->first()->image_name))
                                                <img src="{{ asset('storage/' . $product->images->first()->image_name) }}"
                                                    class="d-block w-100 rounded" alt="..."
                                                    style="max-height: 200px; max-width: 100vw; object-fit: cover;">
                                            @else
                                                @if ($product->images->isNotEmpty())
                                                    <img src="{{ asset('Assets/products/' . $product->images->first()->image_name) }}"
                                                        alt="Product Image" class="card-img-top img-fluid rounded"
                                                        style="max-height: 200px; max-width: 100vw; object-fit: cover;">
                                                @else
                                                    <div class="card-img-top d-flex align-items-center justify-content-center rounded"
                                                        style="max-height: 200px; background: rgba(255, 255, 255, 0.7);">
                                                        <p class="text-muted">No image available</p>
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="position-absolute start-0 top-0 w-100 h-100 rounded"
                                                style="background-color: rgba(255, 255, 255, 0.5)"></div>
                                            <div class="position-absolute start-0 bottom-0 " style="z-index: 2">
                                                <p class="mx-3 my-0 heading">{{ $category->category_name }} -</p>
                                                <p class="mx-3 heading">{{ $product->product_name }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 px-2">
                                            <div class="mb-2">
                                                <p class="text-secondary fw-bold mb-0 text-uppercase">Quantity</p>
                                                <p class="fw-medium mb-0">{{ $orderItem->quantity }}</p>
                                            </div>
                                            <div>
                                                <p class="text-secondary fw-bold mb-0 text-uppercase">Price</p>
                                                <p class="fw-medium mb-0">
                                                    {{ 'Rp' . number_format($productColor->product->price, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- <tr>
                            <td style="white-space: nowrap;">{{ $category->category_name }} -
                                {{ $product->product_name }}</td>
                            <td style="white-space: nowrap;">{{ $color->color_name }}</td>
                            <td style="white-space: nowrap;">{{ $orderItem->quantity }}</td>
                            <td style="white-space: nowrap;">{{ $orderItem->note }}</td>
                            <td style="white-space: nowrap;">
                                {{ 'Rp' . number_format($productColor->product->price, 0, ',', '.') }}</td>
                            <td style="white-space: nowrap;">
                                {{ 'Rp' . number_format($totalAmount, 0, ',', '.') }}</td>
                        </tr> --}}
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
