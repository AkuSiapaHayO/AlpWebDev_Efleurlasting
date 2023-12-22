@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card shadow-lg mb-3 mt-3 mt-md-5" style="border: none;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <a href="{{ route('products.view') }}">
                    <button class="btn btn-pink-color fw-bold text-white">Back</button>
                </a>
                <h1 class="heading mb-0 mx-auto">Edit Categories</h1>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            @foreach ($categories as $category)
                <div class="col mb-3">
                    <div class="card shadow-lg h-100 category-image" style="border: none; transition: 0.3s">
                        <div class="position-relative">
                            @if (File::exists(public_path($category->category_image)))
                                <img src="{{ asset($category->category_image) }}" class="card-img-top"
                                    style="max-height:400px; object-fit:cover" alt="Category Image">
                            @else
                                <img src="{{ asset('Assets/Categories/' . $category->category_image) }}"
                                    class="card-img-top" style="max-height:400px; object-fit:cover" alt="Category Image">
                            @endif
                            <div class="position-absolute start-0 top-0 w-100 h-100"
                                style="background-color: rgb(0, 0, 0, 0.3)"></div>
                            <div class="position-absolute start-0 bottom-0 w-100">
                                <p class="heading ms-3 text-white fs-3">{{ $category->category_name }}</p>
                            </div>
                        </div>

                        <div class="card-body d-flex flex-column justify-content-between">
                            <p class="text">{{ $category->description }}</p>
                            <div class="d-flex flex-column align-items-center">
                                <a href="{{ route('admin.category.show', ['category' => $category->id]) }}"
                                    class="btn btn-sm btn-pink-color fw-bold text-white w-100 mb-3">View</a>
                                <a href="{{ route('category.edit', ['category' => $category->id]) }}"
                                    class="btn btn-sm btn-pink-color fw-bold text-white w-100">Edit</a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col mb-3">
                <div class="card shadow-lg h-100" style="border: none;">
                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="category_image" class="form-label">Category Image</label>
                                <input type="file" class="form-control" id="category_image" name="category_image"
                                    accept="image/*" required>
                                <div id="image-preview-container" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                            </div>

                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="6" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-pink-color fw-bold text-white w-100">Create Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            // Get the file input element
            var input = document.getElementById('category_image');

            // Get the container for image preview
            var previewContainer = document.getElementById('image-preview-container');

            // Clear previous previews
            previewContainer.innerHTML = '';

            // Check if a file is selected
            if (input.files.length > 0) {
                var file = input.files[0];

                // Check if the file is an image
                if (file && file.type.startsWith('image/')) {
                    // Create a new image element
                    var img = document.createElement('img');
                    img.className = 'img-thumbnail'; // Optional: Add a class for styling
                    img.style.width = '100%'; // Set the width of the preview image to 100%
                    img.style.height = '290px'; // Set the height of the preview image
                    img.style.objectFit = 'cover'; // Set object-fit property
                    img.style.marginTop = '20px'; // Add top padding

                    // Set the source of the image to the file object URL
                    img.src = URL.createObjectURL(file);

                    // Append the image to the preview container
                    previewContainer.appendChild(img);
                }
            }
        }

        // Trigger the preview when the file input changes
        document.getElementById('category_image').addEventListener('change', previewImage);
    </script>
@endsection
