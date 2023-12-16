@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Your Cart</h1>

        @if ($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            @php
                $totalAmount = 0;
            @endphp

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                @foreach ($cartItems as $cartItem)
                    @php
                        $productColor = \App\Models\ProductColor::find($cartItem->productcolor_id);
                    @endphp
                    <div class="col mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    @if ($productColor && $productColor->product)
                                        {{ $productColor->product->product_name }}
                                    @else
                                        Product not available
                                    @endif
                                </h5>

                                <p class="card-text">
                                    <strong>Color:</strong>
                                    @if ($productColor && $productColor->color)
                                        {{ $productColor->color->color_name }}
                                    @else
                                        Color not available
                                    @endif
                                </p>

                                <p class="card-text">
                                    <strong>Quantity:</strong> {{ $cartItem->quantity }}
                                </p>

                                <p class="card-text">
                                    <strong>Price:</strong>
                                    @if ($productColor && $productColor->product)
                                        {{ $productColor->product->price }}
                                        @php
                                            // Increment totalAmount by the current product price
                                            $totalAmount += $cartItem->quantity * $productColor->product->price;
                                        @endphp
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p class="card-text">
                                    <strong>Total:</strong>
                                    @if ($productColor && $productColor->product)
                                        {{ $cartItem->quantity * $productColor->product->price }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Display the total amount using the $totalAmount variable --}}
            <p>Total: {{ $totalAmount }}</p>
        @endif
    </div>
@endsection
