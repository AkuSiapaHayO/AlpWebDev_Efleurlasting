@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg p-0" style="max-width: 1540px;">
            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators py-1 m-0">
                    @foreach ($carousels as $key => $carousel)
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}"
                            @if ($key === 0) class="active" aria-current="true" @endif
                            aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner position-relative">
                    @foreach ($carousels as $key => $carousel)
                        <div class="carousel-item @if ($key === 0) active @endif">
                            @if (File::exists(public_path($carousel->image)))
                                <img src="{{ asset($carousel->image) }}" class="d-block w-100" alt="Carousel-Image"
                                    style="max-height: 500px; max-width: 1540px; object-fit: cover;">
                            @else
                                <img src="{{ asset('Assets/' . $carousel->image) }}" class="d-block w-100"
                                    alt="Carousel-Image" style="max-height: 500px; max-width: 1540px; object-fit: cover;">
                            @endif
                            <div
                                class="carousel-captions position-absolute start-0 bottom-0 py-5 w-100 d-none d-md-flex flex-column align-items-center px-5">
                                <h5 class="heading text-black text-center fs-2 py-1 pt-3">{{ $carousel->title }}</h5>
                                <p class="text text-center py-2 text-black fw-semibold w-50">{{ $carousel->description }}
                                </p>
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
            <div class="row py-5 d-flex justify-content-center">
                <div class="col-md-5 px-5 pe-md-3 pb-5 pb-md-0  d-flex justify-content-center">
                    <img src="{{ asset('Assets/Home/HomeImage.jpg') }}" alt=""
                        class="d-block w-80 h-100 img-fluid curved-top img-border"
                        style="max-height: 500px; object-fit: cover;">
                </div>
                <div class="col-md-7 px-5 ps-md-3">
                    <div class="d-flex flex-column justify-content-center h-100">
                        <p class="sub-heading text-secondary borders-left">
                            Efleurlasting
                        </p>
                        <h1 class="heading mb-3 pb-1">What We Do</h1>
                        <p class="text">At Efleurlasting, we bring floral artistry to life, offering a
                            stunning
                            array of handcrafted bouquets designed to elevate your space with timeless elegance. We
                            craft
                            botanical
                            masterpieces that tell stories of beauty, passion, and attention to detail.
                        </p>
                        <a href="{{ route('about') }}"><button class="btn btn-outline-pink-color px-5 fw-bold">More
                                about us</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg pt-5 pb-0 pb-md-5 px-0">
            <div class="px-5 px-md-5 d-flex flex-column align-items-md-center">
                <p class="sub-heading text-secondary text-md-center mb-3 mb-md-2">
                    Featured Categories
                </p>
                <h1 class="heading mb-3 text-md-center">Find your perfect bouquet flower</h1>
                <p class="text text-md-center">
                    Here at Efleurlasting, we take pride in offering a diverse selection of meticulously crafted
                    bouquets.
                    Whether you're drawn to vibrant hues, delicate arrangements, or bold and modern designs, our
                    collection
                    features a bouquet for every taste and occasion.
                </p>
                <a href="{{ route('categories') }}"><button
                        class="btn btn-outline-pink-color px-5 fw-bold">More</button></a>
            </div>
            <div class="pt-5 row row-cols-1 row-cols-lg-3 mx-0">
                @foreach ($categories as $i => $category)
                    <div class="position-relative d-flex justify-content-center mb-5 mb-lg-0 col">
                        <a href="{{ route('category.show', ['category' => $category->id]) }}">
                            @if (File::exists(public_path($category->category_image)))
                                <img src="{{ asset('storage/' . $category->category_image) }}"
                                    class="d-block w-80 h-100 img-fluid curved-top img-border" alt="..."
                                    style="max-height: 500px; object-fit: cover;">
                            @else
                                <img src="{{ asset('Assets/Categories/' . $category->category_image) }}"
                                    class="d-block img-fluid w-80 h-100 curved-top img-border" alt="..."
                                    style="max-height: 500px; object-fit: cover;">
                            @endif
                        </a>
                        <div class="position-absolute start-0 bottom-0 w-100 p-4 d-flex justify-content-center">
                            <h1 class="heading text-white text-center w-50">{{ $category->category_name }}</h1>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg py-5">
            <div class="px-5 px-md-5 d-flex flex-column align-items-md-center mb-4">
                <p class="sub-heading text-secondary text-md-center mb-3 mb-md-2">
                    Testimonies
                </p>
                <h1 class="heading mb-3 text-md-center">Our Customer's Testimonies</h1>
                <p class="text text-md-center">
                    Explore the heartfelt experiences of our valued customers as they share their thoughts and feedback
                    about
                    their journey with us. From delightful surprises to special occasions, our customer testimonies
                    reflect
                    the
                    joy and satisfaction that Efleurlasting brings to every floral moment. Join us in celebrating the
                    stories
                    that make our floral arrangements a cherished part of your memories.
                </p>
            </div>
            <div class="pt-5 mx-0 row row-cols-1 row-cols-lg-2 g-5">
                @foreach ($testimonies as $index => $testimony)
                    <div class="col rounded m-0 mb-4 mb-lg-0">
                        <div class="img-border d-block d-md-flex h-100">
                            <div class="px-0 w-100">
                                @if (File::exists(public_path($testimony->testimony_image)))
                                    <img src="{{ asset($testimony->testimony_image) }}"
                                        class="w-100 h-100 d-block img-fluid" alt="..."
                                        style="max-height: 350px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('Assets/Testimony/' . $testimony->testimony_image) }}"
                                        class="w-100 h-100 d-block img-fluid" alt="..."
                                        style="max-height: 350px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="w-100 p-4 text-center d-flex flex-column justify-content-between">
                                @php
                                    $productColor = \App\Models\ProductColor::find($testimony->productcolor_id);
                                @endphp
                                <div>
                                    <h1 class="sub-heading fs-2 mb-0">
                                        {{ $productColor->product->category->category_name }}</h1>
                                    <p class="text text-center fs-3 mb-0">
                                        {{ $productColor->product->product_name }}
                                    </p>
                                </div>
                                <p class="text text-center fs-5 mb-0">
                                    "{{ $testimony->testimony }}"
                                </p>
                                <p class="text text-start fs-5 mb-0">
                                    {{ $testimony->name }}, {{ $testimony->date }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @auth
        @php($user = Auth::user())
        <section>
            <div class="container-lg py-5">
                <div class="card shadow-lg h-100" style="border: none;">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="heading borders-left">Testimony</h1>
                        <form action="{{ route('testimony.store') }}" method="POST" class="mt-4"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row g-3">
                                <div class="col-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $user->username }}" readonly disabled>
                                </div>
                                <div class="col-8">
                                    <label for="product" class="form-label">Choose Product</label>
                                    <select class="form-select" name="orderitem_id" id="orderitem_id"
                                        aria-label="Default select example" required>
                                        @foreach ($orderItems as $orderItem)
                                            <option value="{{ $orderItem->id }}">
                                                {{ $orderItem->productcolor->product->category->category_name }} -
                                                {{ $orderItem->productcolor->product->product_name }} (Color:
                                                {{ $orderItem->productcolor->color->color_name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="testimony" class="form-label">Leave your testimony here</label>
                                    <textarea class="form-control" id="testimony" name="testimony" rows="5" required></textarea>
                                </div>

                                <div class="col-12">
                                    <label for="product_image" class="form-label">Review Image</label>
                                    <input type="file" name="product_image" id="product_image" class="form-control"
                                        accept="image/jpg, image/png, image/jpeg" onchange="previewImage()">
                                    <img class="img-preview img-fluid mt-3 w-50" style="max-width: 300px">
                                </div>

                            </div>
                            <button type="submit" class="btn btn-pink-color text-white fw-bold mt-4 w-100">Submit
                                Testimony</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endauth

    <section class="contact position-relative mb-5">
        <div class="container-lg">
            <div class="d-flex flex-column align-items-center justify-content-center py-4">
                <div class="w-75">
                    <h1 class="heading text-center text-light">Contact Us</h1>
                    <p class="text text-center text-light">Contact us for further informations on our bouquets. For
                        custom orders, please order via Whats-Apps.
                    </p>
                </div>
                @livewire('chat')
            </div>
        </div>
        <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index: -1; background-color:rgb(0, 0, 0, 0.6)">
        </div>
        <img src="{{ asset('Assets/Categories/CategoryImage7.jpg') }}"
            class="position-absolute top-0 start-0 w-100 h-100" style="z-index:-2; object-fit:cover;" alt="">
    </section>

    <script>
        function previewImage() {
            const image = document.querySelector('#product_image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);

            ofReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
