@extends('layouts.app')

@section('content')

    <section>
        <div class="position-relative">
            <img src="{{ asset('Assets/About/AboutImage1.jpg') }}" class="vw-100 img-fluid"
                style="object-fit: cover; max-height: 35vh; z-index: 0;" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100"
                style="z-index: 1; background-color: rgba(255, 255, 255, 0.7)"></div>
            <div class="position-absolute bottom-0 start-0 w-100 px-5 py-5 d-none d-md-block" style="z-index: 2;">
                <div class="d-flex flex-column align-items-center justify-content-center mb-5">
                    <h1 class="heading borders-left" style="font-size: 60px;">Discover <br>our Products</h1>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <form action="#" method="GET" class="form-inline d-flex gap-2 ms-auto my-4"
                style="max-width: 400px; padding: 0 12px">
                <input class="form-control fw-bold" type="search" name="search" placeholder="Search">
                <button type="submit" class="btn btn-pink-color text-white fw-bold">Search</button>
            </form>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-0">
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
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </section>

    {{-- <section>
        <div class="container-lg">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-0 my-5">
                @foreach ($categories as $category)
                    <div class="col mb-4">
                        <a class="link-light link-offset-2 link-underline link-underline-opacity-0"
                            href="{{ route('category.show', ['category' => $category->id]) }}">
                            <div class="position-relative shadow-lg h-100 category-image" style="transition: 0.3s">
                                @if (File::exists(public_path($category->category_image)))
                                    <img src="{{ asset($category->category_image) }}"
                                        class="d-block w-100 h-100 img-fluid rounded img-shadow" alt="..."
                                        style="max-height: 250px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('Assets/Categories/' . $category->category_image) }}"
                                        class="d-block img-fluid w-100 h-100 rounded img-shadow" alt="..."
                                        style="max-height: 250px; object-fit: cover;">
                                @endif
                                <div class="position-absolute start-0 top-0 w-100 h-100"
                                    style="background-color: rgb(0, 0, 0, 0.5)"></div>
                                <div class="position-absolute start-0 bottom-0" style="z-index: 2;">
                                    <p class="heading ms-3">{{ $category->category_name }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}}

    <section class="contact position-relative my-5">
        <div class="container-lg">
            <div class="d-flex flex-column align-items-center justify-content-center py-4">
                <div class="w-75">
                    <h1 class="heading text-center text-light">Contact Us</h1>
                    <p class="text text-center text-light">Contact us for further informations on our bouquets. For
                        custom orders, please order via Whats-Apps.
                    </p>
                </div>
                <a href="{{ route('chat.whatsapp') }}">
                    <button class="btn btn-light-green text-light fw-bold fs-5" style="padding:10px 40px">
                        <img src="{{ asset('Assets/Icons/whatsapp.png') }}" style="max-width: 30px" class="img-fluid me-2"
                            alt="">
                        Chat Now
                    </button>
                </a>
            </div>
        </div>
        <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index: -1; background-color:rgb(0, 0, 0, 0.6)">
        </div>
        <img src="{{ asset('Assets/Categories/CategoryImage7.jpg') }}" class="position-absolute top-0 start-0 w-100 h-100"
            style="z-index:-2; object-fit:cover;" alt="">
    </section>
@endsection
