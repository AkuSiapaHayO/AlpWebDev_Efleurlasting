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
                    <p class="sub-heading text-secondary ps-3" style="border-left: 7px solid var(--color-7);">Efleurlasting
                    </p>
                    <h1 class="heading mb-3 pb-1">What We Do</h1>
                    <p class="text">Indulge in the everlasting beauty of meticulously crafted artificial flower bouquets
                        that
                        captivate the essence of nature. At Efleurlasting, we bring floral artistry to life, offering a
                        stunning
                        array of handcrafted bouquets designed to elevate your space with timeless elegance. We craft
                        botanical
                        masterpieces that tell stories of beauty, passion, and attention to detail.
                    </p>
                    <a href="#"><button class="btn btn-outline-pink-color px-5 fw-bold">More</button></a>
                </div>
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

    <div class="container pb-5 px-0" style="max-width: 1540px">
        <div class="w-100 bg-color-2">
            <div class="p-5 text-center">
                <p class="sub-heading mb-2 text-secondary">Featured</p>
                <h1 class="heading pb-3 borders">Categories</h1>
            </div>
            <div>
                @foreach ($categories as $i => $category)
                    @if ($i % 2 == 0 || $i == 0)
                        <div class="d-flex justify-content-center align-items-center w-100 pb-5">
                            <div class="row w-75">
                                <div class="col-md-8 py-3 px-5 d-flex align-items-center">
                                    <div>
                                        <p class="sub-heading text-secondary mb-1">Category</p>
                                        <h1 class="heading">{{ $category->category_name }}</h1>
                                        <p class="text">{{ $category->description }}</p>
                                        <a href="#"><button class="btn btn-outline-pink-color px-5 fw-bold">Know
                                                More</button></a>
                                    </div>
                                </div>
                                <div class="col-md-4 px-3 position-relative image">
                                    @if (Storage::disk('public')->exists($category->category_image))
                                        <img src="{{ asset('storage/' . $category->category_image) }}"
                                            class="d-block w-100 rounded img-2" alt="..."
                                            style="max-height: 400px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('Assets/Categories/' . $category->category_image) }}"
                                            class="d-block w-100 rounded img-2" alt="..."
                                            style="max-height: 400px; object-fit: cover;">
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="d-flex justify-content-center w-100 align-items-center pb-5">
                            <div class="row w-75">
                                <div class="col-md-4 px-3 position-relative images">
                                    @if (Storage::disk('public')->exists($category->category_image))
                                        <img src="{{ asset('storage/' . $category->category_image) }}"
                                            class="d-block w-100 rounded img-3" alt="..."
                                            style="max-height: 400px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('Assets/Categories/' . $category->category_image) }}"
                                            class="d-block w-100 rounded img-3" alt="..."
                                            style="max-height: 400px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="col-md-8 py-3 px-5 d-flex align-items-center">
                                    <div>
                                        <p class="sub-heading text-secondary mb-1 text-end">Category</p>
                                        <h1 class="heading text-end">{{ $category->category_name }}</h1>
                                        <p class="text text-end">{{ $category->description }}</p>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <a href="#"><button class="btn btn-outline-pink-color px-5 fw-bold">Know
                                                    More</button></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row">
            <div class="col-md-8 d-flex align-items-center justify-content-center px-5 py-3">
                <div class="w-75">
                    <p class="sub-heading text-secondary">Contact</p>
                    <h1 class="heading">Contact Us</h1>
                    <p class="text">Please contact us for more information or detail about the product. For customization
                        in your order, please contact us via <span class="text-success">Whats-Apps</span> about the detail.
                        Feel free to reach out to us, we value your questions, feedback, and inquiries. Our
                        dedicated team is here to assist you and provide the support you need.</p>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
    </div>
@endsection
