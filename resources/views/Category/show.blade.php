@extends('layouts.app')

@section('content')
    <section>
        <div class="position-relative">
            <img src="{{ asset('Assets/About/AboutImage1.jpg') }}" class="vw-100 img-fluid"
                style="object-fit: cover; max-height: 20vh; z-index: 0;" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100"
                style="z-index: 1; background-color: rgba(255, 255, 255, 0.5)"></div>
            <div class="position-absolute bottom-0 start-0 w-100 px-5 pb-5 d-none d-md-block" style="z-index: 2;">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <h1 class="heading borders-left" style="font-size: 60px;">Discover <br>our Product</h1>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="row py-5">
                <div class="col-md-7 px-4 px-md-5">
                    <div class="card shadow-lg h-100" style="border: none;">
                        <div class="card-body d-flex flex-column justify-content-center p-5">
                            <p class="sub-heading text-secondary borders-left">Category</p>
                            <h1 class="heading mb-3">{{ $category->category_name }}</h1>
                            <p class="text">{{ $category->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    @if (Storage::disk('public')->exists($category->category_image))
                        <img src="{{ asset('storage/' . $category->category_image) }}"
                            class="d-block w-100 h-100 img-fluid rounded img-shadow" alt="..."
                            style="max-height: 500px; object-fit: cover;">
                    @else
                        <img src="{{ asset('Assets/Categories/' . $category->category_image) }}"
                            class="d-block img-fluid w-100 h-100 rounded img-shadow" alt="..."
                            style="max-height: 500px; object-fit: cover;">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-0 py-5">
                @foreach ($products as $product)
                    <div class="col mb-4">
                        <a class="link-offset-2 link-underline link-underline-opacity-0"
                            href="{{ route('product.show', ['product' => $product->id]) }}">
                            <div class="card position-relative shadow-lg h-100 new"
                                style="transition: 0.3s; border-radius: 7px;">
                                {{-- Check if the product has an image --}}
                                @if ($product->images->isNotEmpty() && Storage::disk('public')->exists($product->images->first()->image_name))
                                    <img src="{{ asset('storage/' . $product->images->first()->image_name) }}"
                                        class="d-block w-100" alt="..."
                                        style="max-height: 400px; max-width: 100vw; object-fit: cover;">
                                @else
                                    @if ($product->images->isNotEmpty())
                                        <img src="{{ asset('Assets/products/' . $product->images->first()->image_name) }}"
                                            alt="Product Image" class="card-img-top img-fluid"
                                            style="max-height: 400px; max-width: 100vw; object-fit: cover;">
                                    @else
                                        {{-- Display a placeholder image or text when no image is available --}}
                                        <div class="card-img-top d-flex align-items-center justify-content-center"
                                            style="max-height: 400px; background: rgba(255, 255, 255, 0.7);">
                                            <p class="text-muted">No image available</p>
                                        </div>
                                    @endif
                                @endif

                                {{-- Text and link at the bottom of the card --}}
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
    </section>

    <section class="contact position-relative">
        <div class="container-lg">
            <div class="d-flex flex-column align-items-center justify-content-center py-4">
                <div class="w-75">
                    <h1 class="heading text-center text-light">Contact Us</h1>
                    <p class="text text-center text-light">Contact us for more information about the product. For
                        custom order, please order via Whats-Apps.
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
