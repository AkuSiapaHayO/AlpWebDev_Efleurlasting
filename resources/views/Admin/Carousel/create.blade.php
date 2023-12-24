@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="card my-3 my-md-4 shadow-lg" style="border: none;">
                <div class="p-3 pb-0">
                    <a href="{{ route('carousel.view') }}">
                        <button class="btn btn-pink-color fw-bold text-white">Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('carousel.store') }}" method="POST" class="g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 mb-3">
                            <img class="img-preview img-fluid w-100 rounded"
                                style="max-height:400px; object-fit:cover; display: none;">
                            <img src="{{ asset('Assets/Carousel/CarouselExample.png') }}" alt="" id="upload-text"
                                class="img-fluid w-100 rounded" style="max-height:400px; object-fit:cover;">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="carousel-image" class="form-label fw-bold">Add New Carousel Image</label>
                            <input type="file" id="carousel-image" name="carousel-image" class="form-control"
                                accept="image/jpg, image/png, image/jpeg" onchange="previewImage()" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="title" class="form-label fw-bold">Carousel Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="description" class="form-label fw-bold">Carousel Description</label>
                            <textarea name="description" id="description" cols="30" rows="4" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-pink-color fw-bold text-white w-100 fw-bold">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function previewImage() {
            const image = document.querySelector('#carousel-image');
            const imgPreview = document.querySelector('.img-preview');
            const uploadText = document.querySelector('#upload-text');

            if (image.files.length > 0) {
                imgPreview.style.display = 'block';
                uploadText.style.display = 'none';

                const ofReader = new FileReader();
                ofReader.readAsDataURL(image.files[0]);

                ofReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            } else {
                imgPreview.style.display = 'none';
                uploadText.style.display = 'block';
            }
        }
    </script>
@endsection
