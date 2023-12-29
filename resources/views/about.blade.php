@extends('layouts.app')

@section('content')
    @php($user = Auth::user())
    <section>
        <div class="position-relative">
            <img src="{{ asset('Assets/About/AboutImage1.jpg') }}" class="vw-100 img-fluid"
                style="object-fit: cover; max-height: 35vh; z-index: 0;" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100"
                style="z-index: 1; background-color: rgba(255, 255, 255, 0.7)"></div>
            <div class="position-absolute bottom-0 start-0 w-100 px-5 py-5 d-none d-md-block" style="z-index: 2;">
                <div class="d-flex flex-column align-items-center justify-content-center mb-5">
                    <h1 class="heading borders-left" style="font-size: 60px;">Handcrafted <br> Bouquet</h1>
                </div>
            </div>
        </div>
    </section>

    {{-- Add Pictures if possible--}}
    <section>
        <div class="container my-5">
            <div class="row gy-5">
                <div class="col-md-6">
                    <div class="card shadow-lg h-100" style="border: none;">
                        <div class="card-body p-5">
                            <h1 class="heading borders-left mb-3">Mission</h1>
                            <p class="text">
                                At Efleurlasting, we are driven by a singular mission — to bring everlasting beauty
                                into
                                your
                                life
                                through the artistry of artificial flowers. We believe in providing our customers with an
                                enchanting
                                and
                                timeless alternative to fresh flowers, allowing them to adorn their spaces with elegance
                                that
                                endures. Our
                                commitment to quality craftsmanship and attention to detail reflects our dedication to
                                creating
                                floral
                                arrangements that captivate the senses and elevate every occasion.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-lg h-100" style="border: none;">
                        <div class="card-body p-5">
                            <h1 class="heading borders-left mb-3">Story</h1>
                            <p class="text">Established in 2022, Efleurlasting has blossomed from a small passion
                                project into a leading
                                name in the artificial flower industry. Our journey began with a deep appreciation for the
                                enduring
                                allure of flowers and a desire to offer individuals a sustainable and lasting way to enjoy
                                their
                                beauty. Over the years, we've cultivated a legacy of excellence, evolving our designs and
                                techniques
                                to meet the evolving tastes of our discerning customers. Today, we take pride in our rich
                                history,
                                celebrating every bloom crafted and every customer served.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card shadow-lg h-100" style="border: none;">
                        <div class="card-body p-5">
                            <h1 class="heading borders-left mb-3">Services</h1>
                            <p class="text">
                                Efleurlasting is more than just a provider of artificial flowers; we are curators of
                                enchanting experiences. Our comprehensive range of services includes bespoke floral
                                arrangements
                                for weddings, events, and special occasions, ensuring that each moment is adorned with the
                                timeless elegance of our blooms. Whether you seek a personalized arrangement, expert advice
                                on
                                floral décor, or simply wish to explore our curated collections, our team is dedicated to
                                delivering an unparalleled level of service. From concept to creation, we are committed to
                                making your floral dreams a vibrant reality.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact position-relative">
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
