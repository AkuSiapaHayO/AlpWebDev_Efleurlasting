@extends('layouts.app')

@section('content')
    <div class="container mt-5 vh-100">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('carousel.view') }}">
                    <button class="btn btn-outline-primary">Back</button>
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('carousel.store') }}" method="POST" class="g-3" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <div class="card bg-secondary">
                            <p class="my-2 text-center fw-bold fs-5 text-light text-uppercase">add new carousel image</p>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <img class="img-preview img-fluid w-100 rounded"
                            style="max-height:400px; object-fit:cover; display: none;">
                        <img src="{{ asset('Assets/Carousel/CarouselExample.png') }}" alt="" id="upload-text"
                            class="img-fluid w-100 rounded" style="max-height:400px; object-fit:cover;">
                    </div>
                    <div class="col-12 mt-3">
                        <input type="file" id="carousel-image" name="carousel-image" class="form-control"
                            accept="image/jpg, image/png, image/jpeg" onchange="previewImage()"  required>
                    </div>
                    <div class="col-12 mt-3">
                        <label for="title" class="form-label fw-bold">Carousel Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="col-12 mt-3">
                        <label for="description" class="form-label fw-bold">Carousel Description</label>
                        <textarea name="description" id="description" cols="30" rows="4" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-primary w-100 mt-3 fw-bold">Submit</button>
                </form>
            </div>
        </div>
    </div>

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
