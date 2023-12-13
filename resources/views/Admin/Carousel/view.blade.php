@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($carousels as $i => $carousel)
                        <div class="col">
                            <div class="card w-100">
                                <img src="{{ asset('Assets/Carousel/' . $carousel->image) }}" class="card-img-top"
                                    style="max-height:125px; object-fit:cover" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $carousel->title }}</h5>
                                    <p class="card-text">{{ $carousel->description }}</p>
                                    <a href="#" class="btn btn-outline-primary">Edit Slide {{ $i + 1 }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col">
                        <div class="card w-100 h-100">
                            <div class="card-body p-0">
                                <a href="{{ route('carousel.create') }}">
                                    <button class="btn btn-primary w-100 h-100">
                                        <img src="{{ asset('Assets/Icons/plus.png') }}" alt=""
                                            class="img-fluid w-25">
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
