@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Your Products</h1>

        {{-- Display Categories --}}
        <div class="mb-4">
            <h2>Categories</h2>
            <div class="card-group">
                @foreach ($categories as $category)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->category_name }}</h5>
                            <p class="card-text">{{ $category->description }}</p>
                        </div>
                    </div>
                @endforeach

                {{-- Add New Category Card --}}
                {{-- <div class="card">
                    <a href="{{ route('products.show') }}" class="card-body text-center d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Add New Category</h5>
                        <p class="card-text">Click to add a new category</p>
                    </a>
                </div> --}}
            </div>
        </div>

        {{-- Display Products --}}
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">{{ $product->category->category_name }} - {{ $product->product_name }}</h2>

                            {{-- Display the first associated image --}}
                            @if ($product->images->isNotEmpty())
                                <div style="max-width: 100%; overflow: hidden;">
                                    <img src="{{ asset('Assets/products/' . $product->images->first()->image_name) }}" alt="Product Image" class="img-fluid">
                                </div>
                            @else
                                <p>No images available</p>
                            @endif
                        </div>


                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
