@extends('layouts.app')

@section('content')
    <div class="container p-0" style="max-width: 1540px">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators pb-3">
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
                        {{-- <div class="carousel-caption d-none d-md-block p-5"
                            style="background-image:radial-gradient(circle, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.1), transparent)">
                            <h5>{{ $carousel->title }}</h5>
                            <p>{{ $carousel->description }}</p>
                        </div> --}}
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
@endsection
