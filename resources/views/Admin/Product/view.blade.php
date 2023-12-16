@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.setting') }}">
                    <button class="btn btn-outline-primary">Back</button>
                </a>
                <h1>Edit your Products</h1>
            </div>
            <div class="card-body">

                <div class="accordion accordion-flush mb-4" id="accordionFlushExample">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Categories
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>
                                            Manage all your product categories in one place. Create, update, and delete categories easily with
                                            this section.                                        </p>
                                        <a href="{{ route('admin.categories.view') }}" class="card-link">
                                            <button class="btn btn-outline-primary">Manage Categories</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        Colors
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>
                                            Explore all available colors for your products. Manage and update color options effortlessly in
                                            this section.                                        </p>
                                        <a href="{{ route('user.view') }}" class="card-link">
                                            <button class="btn btn-outline-primary">Manage Colors</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
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
        </div>


    </div>
@endsection
