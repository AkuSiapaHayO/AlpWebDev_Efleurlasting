@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <div class="card shadow-lg mb-3 mt-5 mt-md-5" style="border: none;">
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
                    <img src="{{ asset('Assets/Categories/' . $category->category_image) }}"
                        class="d-block w-100 img-fluid rounded img-shadow"
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
    </div>

    <div class="container-lg mt-5">
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-0">
            @foreach ($products as $product)
                <div class="col mb-4">
                    <a class="link-offset-2 link-underline link-underline-opacity-0"
                        href="{{ route('product.show', ['product' => $product->id]) }}">
                        <div class="card shadow-lg h-100 new" style="transition: 0.3s; border-radius: 7px;">
                            @if (File::exists(public_path($product->images->first()->image_name)))
                                <img src="{{ asset('Products/' . $product->images->first()->image_name) }}"
                                    class="d-block w-100" alt="..." style="max-height: 400px; object-fit: cover;">
                            @else
                                <img src="{{ asset('Assets/Products/' . $product->images->first()->image_name) }}"
                                    class="d-block w-100" alt="..." style="max-height: 400px; object-fit: cover;">
                            @endif
                            <div class="card-body d-flex flex-column justify-content-between">
                                <p class="card-title mb-3 text" style="max-height: 50px; overflow: hidden;">
                                    {{ $product->category->category_name }} - {{ $product->product_name }}
                                </p>
                                <p class="mb-0 text">
                                    Rp {{ number_format($product->price, 0, '.', ',') }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
