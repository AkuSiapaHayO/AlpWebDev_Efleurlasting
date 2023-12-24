@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="row py-4 py-md-5">
                <div class="col-md-6 px-4 px-lg-5 d-flex align-items-center justify-content-center">
                    <div class="card shadow-lg w-100" style="border: none">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner img-shadow">
                                @foreach ($images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        @if (File::exists(public_path($image->image_name)))
                                            <img src="{{ asset('Product/' . $image->image_name) }}" class="d-block w-100"
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
                    <p class="sub-heading text-secondary borders-left">{{ $category->category_name }}</p>
                    <h1 class="heading mb-4 fs-1 border-bottom pb-2">{{ $product->product_name }}</h1>
                    <p class="text-secondary fw-bold mb-0 text-uppercase">Description</p>
                    <p class="text fw-medium">{{ $product->description }}. <br> Free custom Greetings Card</p>
                    <p class="text-secondary fw-bold mb-0 text-uppercase">Size</p>
                    <p class="text fw-medium">{{ $product->size }}</p>
                    <form action="{{ route('cartitem.store') }}" method="POST">
                        @csrf
                        <p class="text-secondary fw-bold mb-1 text-uppercase">Available Color</p>
                        <div class="d-flex flex-column mb-3">
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
                        <p class="text-secondary fw-bold mb-1 text-uppercase">Quantity</p>
                        @livewire('counter')
                        <div class="my-3">
                            <label for="note" class="form-label text-secondary fw-bold mb-0 mb-2">Notes (Input your
                                custom
                                color here)</label>
                            <input type="text" class="form-control" id="note" name="note"
                                placeholder="Input 'none' for non-customizable color" required>
                        </div>
                        <h1 class="my-4" style="font-size: 35px;">Rp {{ number_format($product->price, 0, '.', ',') }}
                        </h1>
                        <button type="submit" class="btn btn-pink-color fw-bold text-white w-100">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
