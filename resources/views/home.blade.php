@extends('layouts.app')

@section('content')
    <section class="bg-color-1">
        <div class="container-lg p-0" style="max-width: 1540px;">
            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators py-3 m-0">
                    @foreach ($carousels as $key => $carousel)
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}"
                            @if ($key === 0) class="active" aria-current="true" @endif
                            aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($carousels as $key => $carousel)
                        <div class="carousel-item @if ($key === 0) active @endif">
                            @if (Storage::disk('public')->exists($carousel->image))
                                <img src="{{ asset('storage/' . $carousel->image) }}" class="d-block w-100" alt="..."
                                    style="max-height: 60vh; max-width: 1540px; object-fit: cover;">
                            @else
                                <img src="{{ asset('Assets/Carousel/' . $carousel->image) }}" class="d-block w-100"
                                    alt="..." style="max-height: 60vh; max-width: 1540px; object-fit: cover;">
                            @endif
                            <div class="carousel-caption d-none d-md-block px-5">
                                <h5 class="heading text-dark fs-2 py-1 pt-3">{{ $carousel->title }}</h5>
                                <p class="text text-center py-1 text-dark">{{ $carousel->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="row py-5">
                <div class="col-md-7 d-flex align-items-center justify-content-center px-5 py-3">
                    <div>
                        <p class="sub-heading text-secondary ps-3 borders-left" >
                            Efleurlasting
                        </p>
                        <h1 class="heading mb-3 pb-1">What We Do</h1>
                        <p class="text">At Efleurlasting, we bring floral artistry to life, offering a
                            stunning
                            array of handcrafted bouquets designed to elevate your space with timeless elegance. We craft
                            botanical
                            masterpieces that tell stories of beauty, passion, and attention to detail.
                        </p>
                        <a href="#"><button class="btn btn-outline-pink-color px-5 fw-bold">More</button></a>
                    </div>
                </div>
                <div class="col-md-5 d-flex align-items-center justify-content-center px-5 py-3">
                    <div class="position-relative">
                        <img src="{{ asset('Assets/Products/mixbouquet_sizepetite_2.jpg') }}" alt=""
                            class="d-block w-100 img-fluid" style="max-height: 400px; object-fit:cover;">
                        <div id="img-1" class="w-100 h-100"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-color-2">
        <div class="container-lg">
            <div class="px-5 pt-5 text-center">
                <p class="sub-heading mb-2 text-secondary">Efleurlasting</p>
                <h1 class="heading pb-3 borders-bottom-1">Categories</h1>
            </div>
            @foreach ($categories as $i => $category)
                <div class="row py-5">
                    <div class="col-md-7 d-flex align-items-center justify content-center px-5 py-3">
                        <div>
                            <p class="sub-heading text-secondary mb-1">Efleurlasting</p>
                            <h1 class="heading">{{ $category->category_name }}</h1>
                            <p class="text">{{ $category->description }}</p>
                            <a href="#"><button class="btn btn-outline-pink-color px-5 fw-bold">Know
                                    More</button></a>
                        </div>
                    </div>
                    <div class="col-md-5 d-flex align-items-center justify-content-center px-5 py-3">
                        @if (Storage::disk('public')->exists($category->category_image))
                            <img src="{{ asset('storage/' . $category->category_image) }}"
                                class="d-block img-fluid w-100 rounded img-2" alt="..."
                                style="max-height: 400px; object-fit: cover;">
                        @else
                            <img src="{{ asset('Assets/Categories/' . $category->category_image) }}"
                                class="d-block img-fluid w-100 rounded img-2" alt="..."
                                style="max-height: 400px; object-fit: cover;">
                        @endif
                    </div>
                </div>
            @endforeach
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
        <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index: -1; background-color:rgb(0, 0, 0, 0.6)"></div>
        <img src="{{ asset('Assets/Categories/CategoryImage7.jpg') }}" class="position-absolute top-0 start-0 w-100 h-100" style="z-index:-2; object-fit:cover; filter:blur(4px)" alt="">
    </section>
@endsection
