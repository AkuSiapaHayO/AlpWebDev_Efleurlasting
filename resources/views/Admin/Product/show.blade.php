@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            {{-- Display associated Images on the left side --}}
            <div class="col-md-4">
                <div class="card">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($images as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('Assets/products/' . $image->image_name) }}" alt="Product Image"
                                        class="d-block w-100">
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

            {{-- Display other product details on the right side --}}
            <div class="col-md-8">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-8">
                            <h1>{{ $category->category_name }} - {{ $product->product_name }}</h1>
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
                                    <div class="col-auto mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="card-text">{{ $productColor->color->color_name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
