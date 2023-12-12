@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Products</h1>

        {{-- Display Categories --}}
        <div class="mb-4">
            <h2>Categories</h2>
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item">{{ $category->category_name }}</li>
                @endforeach
            </ul>
        </div>

        {{-- Display Products --}}
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <a href="{{ route('showproduct', ['product' => $product->id]) }}" class="btn btn-primary">
                        <div class="card-body">
                                <h2 class="card-title">{{ $product->product_name }}</h2>
                                {{-- Access the category information --}}
                                <p class="card-text">Category: {{ $product->category->category_name }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
