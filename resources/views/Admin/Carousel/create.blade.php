@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('carousel.store') }}" method="POST" class="g-3" enctype="multipart/form-data">
                    <div class="col-12">
                        <div class="card bg-secondary">
                            <p class="my-2 text-center fw-bold fs-5 text-light text-uppercase">add new carousel image</p>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <img class="img-preview img-fluid w-100 rounded" style="max-height:400px; object-fit:cover; display: none;">
                        <img src="{{asset('Assets/Carousel/CarouselExample.png')}}" alt="" id="upload-text" class="img-fluid w-100 rounded" style="max-height:400px; object-fit:cover;">
                    </div>
                    <div class="col-12 mt-3">
                        <input type="file" id="profile-image" name="profile-image" class="form-control"
                            accept="image/jpg, image/png, image/jpeg" onchange="previewImage()">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#profile-image');
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
