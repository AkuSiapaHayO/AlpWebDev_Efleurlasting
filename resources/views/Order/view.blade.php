@extends('layouts.app')

@section('content')
    <section>
        <div class="position-relative">
            <img src="{{ asset('Assets/About/AboutImage1.jpg') }}" class="vw-100 img-fluid"
                style="object-fit: cover; max-height: 30vh; z-index: 0;" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100"
                style="z-index: 1; background-color: rgba(255, 255, 255, 0.7)"></div>
            <div class="position-absolute bottom-0 start-0 w-100 px-5 py-1 d-none d-md-block" style="z-index: 2;">
                <div class="d-flex flex-column align-items-center justify-content-center mb-5">
                    <h1 class="heading borders-left" style="font-size: 60px;">Orders</h1>
                    <a href="{{ route('user.setting') }}"><button
                            class="btn btn-pink-color fw-bold text-white">Back</button></a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg mt-5">
            @foreach ($orders as $order)
                <div class="card mb-3 shadow-lg p-0 p-lg-3" style="border: none;">
                    <div class="card-body">
                        <p class="fw-bolder fs-4 text-uppercase">Order ID : <span
                                style="color: #ee7c99">{{ $order->id }}</span>
                        </p>
                        <div class="row row-cols-1 row-cols-lg-4">
                            <div class="col">
                                <p class="text-secondary fw-bold mb-0 text-uppercase">Total Amount</p>
                                <p class="fw-medium">{{ number_format($order->total_amount, 0, ',', '.') }}</p>

                            </div>
                            <div class="col">
                                <p class="text-secondary fw-bold mb-0 text-uppercase">Order Date</p>
                                <p class="fw-medium">{{ $order->order_date }}</p>
                            </div>
                            <div class="col">
                                <p class="text-secondary fw-bold mb-0 text-uppercase">Delivery Date</p>
                                <p class="fw-medium">{{ $order->delivery_date }}</p>
                            </div>
                            <div class="col">
                                <p class="text-secondary fw-bold mb-0 text-uppercase">Delivery Time</p>
                                <p class="fw-medium">{{ $order->delivery_time }}</p>
                            </div>
                        </div>

                        <p class="haeding text-secondary fw-bold mb-0 text-uppercase">Order Items</p>
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
                                                @if (File::exists(public_path($product->images->first()->image_name)))
                                                    <img src="{{ asset('Products/' . $product->images->first()->image_name) }}"
                                                        class="d-block w-100 rounded" alt="..."
                                                        style="max-height: 200px; max-width: 100vw; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('Assets/Products/' . $product->images->first()->image_name) }}"
                                                        class="d-block w-100 rounded" alt="..."
                                                        style="max-height: 200px; max-width: 100vw; object-fit: cover;">
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
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
