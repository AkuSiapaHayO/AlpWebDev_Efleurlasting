@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="card shadow-lg my-3 my-md-4" style="border: none;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <a href="{{ route('products.view') }}">
                        <button class="btn btn-pink-color fw-bold text-white">Back</button>
                    </a>
                    <h1 class="heading mx-auto mb-0">View Product</h1>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="row pb-4 py-md-4">
                <div class="col-md-6 px-4 px-lg-5 d-flex align-items-center justify-content-center">
                    <div class="card shadow-lg w-100" style="border: none;">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner img-shadow">
                                @foreach ($images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        @if (File::exists(public_path($image->image_name)))
                                            <img src="{{ asset($image->image_name) }}" class="d-block w-100 img-shadow"
                                                alt="Product Image" style="max-height: 500px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('Assets/Products/' . $image->image_name) }}"
                                                alt="Product Image" class="d-block w-100"
                                                style="max-height: 500px; object-fit: cover;">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-4 px-md-4 px-lg-5 pt-5 pt-md-0">
                    <h1 class="heading">{{ $category->category_name }} - {{ $product->product_name }}</h1>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Description</th>
                                <td>{{ $product->description }}</td>
                            </tr>
                            <tr>
                                <th>Size</th>
                                <td>{{ $product->size }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{ $product->price }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h4>Available Colors</h4>
                    <div class="row">
                        @foreach ($productColors as $productColor)
                            <div class="col mb-2 mb-md-0">
                                <div class="card shadow-lg" style="border: none;">
                                    <div class="card-body p-2">
                                        <p class="text-md-center mb-0">{{ $productColor->color->color_name }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('products.edit', ['product' => $product]) }}"
                        class="btn btn-pink-color fw-bold text-white w-100 mt-2 mt-md-3">Edit</a>
                </div>
            </div>
        </div>
    </section>
@endsection
