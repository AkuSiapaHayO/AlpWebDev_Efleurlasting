@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="card shadow-lg my-3 my-md-4" style="border: none;">
                <div class="p-3 pb-0">
                    <a href="{{ route('admin.setting') }}">
                        <button class="btn btn-pink-color fw-bold text-white">Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach ($carousels as $i => $carousel)
                            <div class="col">
                                <div class="card w-100 h-100">
                                    @if (File::exists(public_path($carousel->image)))
                                        <img src="{{ asset($carousel->image) }}" class="card-img-top"
                                            style="max-height:125px; object-fit:cover" alt="Carousel-Image">
                                    @else
                                        <img src="{{ asset('Assets/' . $carousel->image) }}" class="card-img-top"
                                            style="max-height:125px; object-fit:cover" alt="Carousel-Image">
                                    @endif
                                    <div class="card-body">
                                        <div class="border-bottom pb-3">
                                            <h5 class="card-title">{{ $carousel->title }}</h5>
                                            <p class="card-text">{{ $carousel->description }}</p>
                                        </div>
                                        <div class="border-bottom pb-3">
                                            <form action="{{ route('carousel.update', $carousel) }}" class="mt-3"
                                                method="POST">
                                                @csrf
                                                @method('put')
                                                <div>
                                                    <label for="title" class="form-label">New Title</label>
                                                    <input type="text" name="title" id="title" class="form-control"
                                                        placeholder="Insert New Title" required>
                                                </div>
                                                <div class="mt-3">
                                                    <label for="description" class="form-label">New Description</label>
                                                    <input type="text" name="description" id="description"
                                                        class="form-control" placeholder="Insert New Description" required>
                                                </div>
                                                <button type="submit" class="btn btn-outline-primary w-100 mt-3">Edit
                                                    Slide
                                                </button>
                                            </form>
                                            <form action="{{ route('carousel.updateImage', $carousel) }}" class="mt-3"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div>
                                                    <label for="carousel-image" class="form-label">Insert New Image</label>
                                                    <input type="file" name="carousel-image" id="carousel-image"
                                                        class="form-control" required>
                                                </div>
                                                <button class="mt-3 btn btn-outline-primary w-100">Edit Image</button>
                                            </form>
                                        </div>
                                        <div>
                                            <p>
                                                <button class="btn btn-outline-danger w-100" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseExample{{ $i + 1 }}"
                                                    aria-expanded="false" aria-controls="collapseExample">
                                                    Delete Slide
                                                </button>
                                            </p>
                                            <div class="collapse" id="collapseExample{{ $i + 1 }}">
                                                <div class="card card-body">
                                                    <p><span class="text-danger">Warning: </span>Deleted slide cannot be
                                                        restored
                                                    </p>
                                                    <form action="{{ route('carousel.destroy', $carousel) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger w-100">Confirm Delete Slide</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
    </section>
@endsection
