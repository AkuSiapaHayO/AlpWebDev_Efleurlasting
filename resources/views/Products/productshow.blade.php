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
    </div>
@endsection
