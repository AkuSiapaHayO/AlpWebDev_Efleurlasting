@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">{{ $category->category_name }} Products</h1>
        <p class="card-text">{{ $category->description }}</p>

        {{-- Display Products --}}
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-6">
                @foreach ($products as $product)
                    <div class="col mb-4">
                        <div class="card position-relative">
                            {{-- Check if the product has an image --}}
                            @if ($product->images->isNotEmpty())
                                <img src="{{ asset('Assets/products/' . $product->images->first()->image_name) }}"
                                    alt="Product Image" class="card-img-top img-fluid"
                                    style="height: 250px; object-fit: cover;">
                            @else
                                {{-- Display a placeholder image or text when no image is available --}}
                                <div class="card-img-top d-flex align-items-center justify-content-center"
                                    style="height: 250px; background: rgba(255, 255, 255, 0.7);">
                                    <p class="text-muted">No image available</p>
                                </div>
                            @endif

                            {{-- Text and link at the bottom of the card --}}
                            <div class="card-body">
                                <h6 class="card-title mb-0" style="max-height: 50px; overflow: hidden;">
                                    {{ $product->category->category_name }} - {{ $product->product_name }}
                                </h6>
                                <a href="{{ route('product.show', ['product' => $product->id]) }}"
                                    class="btn btn-primary mt-2">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
