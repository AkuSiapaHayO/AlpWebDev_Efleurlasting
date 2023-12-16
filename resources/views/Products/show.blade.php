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
                                    @if (Storage::disk('public')->exists($image->image_name))
                                        <img src="{{ asset('storage/' . $image->image_name) }}" class="d-block w-100"
                                            alt="Product Image" style="height: 75vh; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('Assets/products/' . $image->image_name) }}" alt="Product Image"
                                            class="d-block w-100" style="height: 75vh; object-fit: cover;">
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
                </div>
            </div>
        </div>
    </div>
@endsection
