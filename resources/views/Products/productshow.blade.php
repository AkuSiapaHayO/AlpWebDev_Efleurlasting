@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>{{ $product->product_name }}</h1>
        <p>Description: {{ $product->description }}</p>
        <p>Size: {{ $product->size }}</p>
        <p>Price: {{ $product->price }}</p>

        {{-- Access the associated category --}}
        <p>Category: {{ $category->category_name }}</p>

        {{-- Display associated ProductColors --}}
        <h2>Product Colors</h2>
        <ul>
            @foreach ($productColors as $productColor)
                <li>
                    Color ID: {{ $productColor->color_id }}
                    Color Name: {{ $productColor->color->color_name }}
                    {{-- Add other fields you want to display --}}
                </li>
            @endforeach
        </ul>

        {{-- Display associated Images --}}
        <h2>Images</h2>
        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-4 mb-4">
                    <div style="max-width: 300px; oveflow: hidden" class="mb-3">
                        {{-- ROUTE BUAT KE IMAGE NYA?? --}}
                        <img src="{{ asset('Assets/products/' . $image->image_name) }}" alt="Profile-image" class="img-fluid" style="max-height: 300px;">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
