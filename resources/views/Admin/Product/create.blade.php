@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Create New Product</h1>

        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="size" class="form-label">Size</label>
                <input type="text" class="form-control" id="size" name="size" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="" disabled selected>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="images" class="form-label">Product Images</label>
                <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple onchange="previewImages()">
            </div>

            <div class="col-12">
                <label for="profile-image" class="form-label">Upload Profile Image</label>
                <input type="file" id="profile-image" name="profile-image" class="form-control"
                    accept="image/jpg, image/png, image/jpeg" onchange="previewImage()">
                <img class="img-preview img-fluid mt-3 col-sm-5 w-25">
            </div>

            <button type="submit" class="btn btn-success">Create Product</button>
        </form>
    </div>

    <script>
        function previewImages() {
            const imagesInput = document.querySelector('#images');
            const imagesPreview = document.querySelector('#product-images-preview');

            imagesPreview.innerHTML = '';

            for (const file of imagesInput.files) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.classList.add('img-fluid', 'mt-3', 'col-sm-5', 'w-25');
                    imagesPreview.appendChild(imgElement);
                };

                reader.readAsDataURL(file);
            }
        }

        function previewImage() {
            const image = document.querySelector('#profile-image');
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

