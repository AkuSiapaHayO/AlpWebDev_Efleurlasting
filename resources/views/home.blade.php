@extends('layouts.app')

@section('content')
    <div class="container p-0 pb-5" style="max-width: 1540px">
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
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-8 px-5 d-flex align-items-center" style="border-radius:0 0 0 30px">
                <div class="mb-5">
                    <p class="sub-heading text-secondary">Efleurlasting</p>
                    <h1 class="heading mb-3 pb-1">What We Do</h1>
                    <p class="text">Indulge in the everlasting beauty of meticulously crafted artificial flower bouquets
                        that
                        captivate the essence of nature. At Efleurlasting, we bring floral artistry to life, offering a
                        stunning
                        array of handcrafted bouquets designed to elevate your space with timeless elegance. We craft
                        botanical
                        masterpieces that tell stories of beauty, passion, and attention to detail.
                    </p>
                </div>
                {{-- <div class="mb-5">
                    <h1 class="heading mb-3 pb-1">Blossom That Last</h1>
                    <p class="text">Our exquisite collection showcases a harmonious blend of art and nature. Each bouquet
                        is a testament to craftsmanship, featuring the finest artificial flowers that rival the beauty of
                        their living counterparts. Revel in the joy of everlasting blooms that never fade.
                    </p>
                </div>
                <div class="mb-5">
                    <h1 class="heading mb-3 pb-1">Perfect Gifts, Timeless Memories</h1>
                    <p class="text">Looking for a gift that lasts forever? Our artificial flower bouquets make for
                        unforgettable presents. Celebrate special moments, express love, and send messages of joy with the
                        enduring beauty of our thoughtfully crafted arrangements.
                    </p>
                </div> --}}
            </div>
            <div class="col-md-4 m-0 px-3 d-flex align-items-center justify-content-center">
                <div class="position-relative">
                    <img src="{{ asset('Assets/Products/mixbouquet_sizepetite_2.jpg') }}" alt=""
                        class="w-100 img-fluid" style="border-radius:0 0 0 0; max-height: 400px; object-fit:cover;">
                    <div id="img-1" class="w-100 h-100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pb-5 bg-color-2" style="max-width: 1540px">
        <div class="p-5 text-center">
            <p class="sub-heading mb-2">Featured</p>
            <h1 class="heading">Categories</h1>
        </div>
        @foreach ($categories as $i => $category)
            @if ($i % 2 == 0 || $i == 0)
                <div class="row">
                    <div class="col-md-8">
                        
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-8">

                    </div>
                </div>
            @endif
        @endforeach

    </div>
@endsection
