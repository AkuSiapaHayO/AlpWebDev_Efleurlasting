@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit your Products</h1>

        <div class="accordion accordion-flush mb-4" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Add New Category
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="card-title">Create New Category</h5>
                                <form action="{{ route('category.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="category_name" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Create Category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Display Categories, too much makes the view so ew --}}
        <div class="mb-4">
            <h2>Categories</h2>
            <div class="card-group">
                @foreach ($categories as $category)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="height: 50px; overflow: hidden;">{{ $category->category_name }}
                            </h5>
                            <p class="card-text">{{ $category->description }}</p>
                            <a href="{{ route('category.show', ['category' => $category->id]) }}"
                                class="btn btn-sm btn-primary">View</a>
                            <a href="{{ route('category.edit', ['category' => $category->id]) }}"
                                class="btn btn-sm btn-secondary">Edit</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>

        {{-- Display Products --}}
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-6">
                @foreach ($products as $product)
                    <div class="col mb-4">
                        <div class="card position-relative">
                            {{-- Check if the product has an image --}}
                            @if ($product->images->isNotEmpty() && Storage::disk('public')->exists($product->images->first()->image_name))
                                <img src="{{ asset('storage/' . $product->images->first()->image_name) }}"
                                    class="d-block w-100" alt="..."
                                    style="max-height: 50vh; max-width: 100vw; object-fit: cover;">
                            @else
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
                            @endif

                            {{-- Text and link at the bottom of the card --}}
                            <div class="card-body">
                                <h6 class="card-title mb-0" style="max-height: 50px; overflow: hidden;">
                                    {{ $product->category->category_name }} - {{ $product->product_name }}
                                </h6>
                                <a href="{{ route('products.show', ['product' => $product->id]) }}"
                                    class="btn btn-primary mt-2">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
