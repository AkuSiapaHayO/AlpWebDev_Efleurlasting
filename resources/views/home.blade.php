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
                            @if (Storage::disk('public')->exists($carousel->image))
                                <img src="{{ asset('storage/' . $carousel->image) }}" class="d-block w-100" alt="..."
                                    style="max-height: 60vh; max-width: 1540px; object-fit: cover;">
                            @else
                                <img src="{{ asset('Assets/Carousel/' . $carousel->image) }}" class="d-block w-100"
                                    alt="..." style="max-height: 60vh; max-width: 1540px; object-fit: cover;">
                            @endif
                            <div
                                class="carousel-captions position-absolute start-0 bottom-0 py-5 w-100 d-none d-md-block px-5">
                                <h5 class="heading text-black text-center fs-2 py-1 pt-3">{{ $carousel->title }}</h5>
                                <p class="text text-center py-2 text-black fw-semibold">{{ $carousel->description }}</p>
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
                <div class="col-md-7 mb-5 mb-md-0 px-4 px-md-3">
                    <div class="card shadow-lg h-100" style="border: none;">
                        <div class="card-body d-flex flex-column justify-content-center p-5">
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
                            <a href="#"><button class="btn btn-outline-pink-color px-5 fw-bold">More</button></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 px-4 px-md-4">
                    <img src="{{ asset('Assets/Products/mixbouquet_sizepetite_2.jpg') }}" alt=""
                        class="d-block w-100 h-100 img-fluid rounded img-shadow"
                        style="max-height: 500px; object-fit:cover;">
                </div>
            </div>
    </section>

    <section>
        <div class="container-lg">
            @foreach ($categories as $i => $category)
                <div class="row pb-5">
                    <div class="col-md-7 mb-5 mb-md-0 px-4 px-md-3">
                        <div class="card shadow-lg h-100" style="border: none;">
                            <div class="card-body d-flex flex-column justify-content-center p-5">
                                <p class="sub-heading text-secondary mb-3 borders-left">Featured Category</p>
                                <h1 class="heading">{{ $category->category_name }}</h1>
                                <p class="text">{{ $category->description }}</p>
                                <a href="#"><button class="btn btn-outline-pink-color px-5 fw-bold">Know
                                        More</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 px-4 px-md-4">
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
            @endforeach
        </div>
    </section>

    @auth
        @php($user = Auth::user())
        <section>
            <div class="container-lg">
                <div class="card shadow-lg h-100 mb-5" style="border: none;">
                    <div class="card-body p-5">
                        <h1 class="heading borders-left">Testimonial</h1>
                        <form action="" class="mt-5">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $user->username }}" readonly disabled>
                                </div>
                                <div class="col-12">

                                </div>
                                <div class="col-12">
                                    <label for="testimony" class="form-label">Leave your testimony here</label>
                                    <textarea class="form-control" id="testimony" name="testimony" rows="5" required></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="product" class="form-label">Choose Product</label>
                                    <select class="form-select" name="product" id="product"
                                        aria-label="Default select example" required>
                                        <option value="" disabled selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="product-image" class="form-label">Review Image</label>
                                    <input type="file" id="product-image" name="product-image" class="form-control"
                                        accept="image/jpg, image/png, image/jpeg" onchange="previewImage()">
                                    <img class="img-preview img-fluid mt-3 w-50" style="max-width: 300px">
                                </div>
                                <input type="hidden" value="{{ $user->id }}">
                            </div>
                            <button type="submit" class="btn btn-pink-color text-white fw-bold mt-4 w-100">Submit
                                Testimony</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endauth


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
                        <img src="{{ asset('Assets/Icons/whatsapp.png') }}" style="max-width: 30px"
                            class="img-fluid me-2" alt="">
                        Chat Now
                    </button>
                </a>
            </div>
        </div>
        <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index: -1; background-color:rgb(0, 0, 0, 0.6)">
        </div>
        <img src="{{ asset('Assets/Categories/CategoryImage7.jpg') }}"
            class="position-absolute top-0 start-0 w-100 h-100" style="z-index:-2; object-fit:cover;" alt="">
    </section>

    <script>
        function previewImage() {
            const image = document.querySelector('#product-image');
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
