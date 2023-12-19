@extends('layouts.app')

@section('content')
    <div class="container-lg vh-100">
        <div class="row py-4 py-md-5">
            <div class="col-md-6 px-4 px-md-4 px-lg-5">
                <div class="card shadow-lg" style="border: none">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner img-shadow">
                            @foreach ($images as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    @if (Storage::disk('public')->exists($image->image_name))
                                        <img src="{{ asset('storage/' . $image->image_name) }}" class="d-block w-100"
                                            alt="Product Image" style="height: 50vh; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('Assets/products/' . $image->image_name) }}" alt="Product Image"
                                            class="d-block w-100" style="height: 50vh; object-fit: cover;">
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

            {{-- Display other product details on the right side --}}
            <div class="col-md-6 px-4 px-md-4 px-lg-5 pt-5 pt-md-0">
                <p class="sub-heading text-secondary borders-left">{{ $category->category_name }}</p>
                <h1 class="heading mb-4 fs-1 border-bottom pb-2">{{ $product->product_name }}</h1>
                <p class="text-secondary fw-bold mb-0 text-uppercase">Description</p>
                <p class="text fw-medium">{{ $product->description }}</p>
                <p class="text-secondary fw-bold mb-0 text-uppercase">Size</p>
                <p class="text fw-medium">{{ $product->size }}</p>
                <form action="{{ route('cartitem.store') }}" method="POST">
                    @csrf
                    <p class="text-secondary fw-bold mb-1 text-uppercase">Available Color</p>
                    <div class="d-flex flex-column">
                        @foreach ($productColors as $productColor)
                            <div class="d-flex align-items-center">
                                <input type="radio" name="productcolor" id="productcolor_{{ $productColor->id }}"
                                    value="{{ $productColor->id }}" required>
                                <label for="productcolor_{{ $productColor->id }}" class="form-label ms-2 mb-0">
                                    {{ $productColor->color->color_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </form>
                {{-- <h1 class="heading" style="font-size: 40px">Rp {{ number_format($product->price, 0, '.', ',') }}</h1> --}}
                {{-- <div class="container mt-4">
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
                                <form action="{{ route('cartitem.store') }}" method="post">
                                    @csrf
                                    @foreach ($productColors as $productColor)
                                        <div class="col-auto mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <input type="radio" name="productcolor"
                                                        id="productcolor_{{ $productColor->id }}"
                                                        value="{{ $productColor->id }}" required>
                                                    <label for="productcolor_{{ $productColor->id }}">
                                                        {{ $productColor->color->color_name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="note" class="form-label">Note</label>
                                        <input type="text" class="form-control" id="note" name="note" placeholder="Add notes for us">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
