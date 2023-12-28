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
                    <h1 class="heading borders-left" style="font-size: 60px;">Discover <br>our Categories</h1>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg my-5 px-auto">

            <div class="row d-flex align-items-center">
                <div class="col-md-7">
                    <p class="sub-heading text-secondary borders-left">
                        Categories
                    </p>
                    <h1 class="heading mb-3 pb-1">Find your perfect bouquet flower</h1>
                    <p class="text my-auto">
                        Here at Efleurlasting, we take pride in offering a diverse selection of meticulously crafted
                        bouquets.
                        Whether you're drawn to vibrant hues, delicate arrangements, or bold and modern designs, our
                        collection
                        features a bouquet for every taste and occasion.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-0 my-5">
                @foreach ($categories as $category)
                    <div class="col mb-4">
                        <a class="link-light link-offset-2 link-underline link-underline-opacity-0"
                            href="{{ route('category.show', ['category' => $category->id]) }}">
                            <div class="position-relative h-100 category-image" style="transition: 0.3s">
                                @if (File::exists(public_path($category->category_image)))
                                    <img src="{{ asset($category->category_image) }}"
                                        class="d-block w-100 h-100 img-fluid curved-top img-border" alt="..."
                                        style="max-height: 250px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('Assets/Categories/' . $category->category_image) }}"
                                        class="d-block img-fluid w-100 h-100 curved-top img-border" alt="..."
                                        style="max-height: 250px; object-fit: cover;">
                                @endif
                                <div class="position-absolute start-0 top-0 w-100 h-100 curved-top"
                                    style="background-color: rgb(0, 0, 0, 0.3)"></div>
                                <div class="position-absolute start-0 bottom-0" style="z-index: 2;">
                                    <p class="heading ms-3">{{ $category->category_name }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

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
