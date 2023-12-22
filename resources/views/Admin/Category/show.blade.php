@extends('layouts.app')

@section('content')
    <div class="container-lg">

        <div class="card shadow-lg mb-3 mt-3 mt-md-5" style="border: none;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.categories.view') }}">
                    <button class="btn btn-pink-color fw-bold text-white">Back</button>
                </a>
                <h1 class="heading mx-auto mb-0">View Category</h1>
            </div>
        </div>

        <div class="card shadow-lg" style="border: none;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                @if (File::exists(public_path($category->category_image)))
                    <img src="{{ asset($category->category_image) }}" class="d-block w-100 img-fluid rounded img-shadow"
                        style="max-height:400px; max-width: 500px; object-fit:cover" alt="Category Image">
                @else
                    <img src="{{ asset('Assets/Categories/' . $category->category_image) }}" class="d-block w-100 img-fluid rounded img-shadow"
                        style="max-height:400px; max-width: 500px; object-fit:cover" alt="Category Image">
                @endif
                <div class="my-4">
                    <h1 class="heading mt-3 text-center" style="overflow: hidden;">
                        {{ $category->category_name }}
                    </h1>
                    <p class="text text-center mb-0 px-lg-5">{{ $category->description }}</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Products</h4>
            </div>
            <div class="card-body">
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
                                            style="max-height: 50vh; max-width: 100vw; object-fit: cover;">
                                    @else
                                        {{-- Display a placeholder image or text when no image is available --}}
                                        <div class="card-img-top d-flex align-items-center justify-content-center"
                                            style="height: 50vh; width:100vw; background: rgba(255, 255, 255, 0.7);">
                                            <p class="text-muted">No image available</p>
                                        </div>
                                    @endif
                                @endif

                                {{-- Text and link at the bottom of the card --}}
                                <div class="card-body">
                                    <h6 class="card-title mb-0" style="max-height: 50px; overflow: hidden;">
                                        {{ $product->category->category_name }} - {{ $product->product_name }}
                                    </h6>
                                    <p>{{ $product->is_active ? 'Active' : 'InActive' }}</p>
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
@endsection
