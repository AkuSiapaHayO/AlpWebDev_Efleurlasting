@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('products.view') }}">
                    <button class="btn btn-outline-primary">Back</button>
                </a>
                <h1>Edit Categories</h1>
            </div>
            <div class="card-body">
                {{-- Display Categories --}}
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($categories as $category)
                        <div class="col">
                            <div class="card w-100 h-100">
                                @if ($category->category_image && Storage::disk('public')->exists($category->category_image))
                                    <img src="{{ asset('storage/' . $category->category_image) }}" class="card-img-top"
                                        style="max-height:400px; object-fit:cover" alt="Category Image">
                                @else
                                    <img src="{{ asset('Assets/Categories/' . $category->category_image) }}"
                                        class="card-img-top" style="max-height:400px; object-fit:cover"
                                        alt="Category Image">
                                @endif
                                <div class="card-body">
                                    <h4 class="card-title" style="overflow: hidden;">
                                        {{ $category->category_name }}
                                    </h4>
                                    <p class="card-text" style="height: 200px; overflow-y: auto;">{{ $category->description }}</p>
                                    <a href="{{ route('admin.category.show', ['category' => $category->id]) }}"
                                        class="btn btn-sm btn-primary">View</a>
                                    <a href="{{ route('category.edit', ['category' => $category->id]) }}"
                                        class="btn btn-sm btn-secondary">Edit</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col">
                        <div class="card w-100 h-100">
                            <div class="m-3">
                                <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="category_image" class="form-label">Category Image</label>
                                        <input type="file" class="form-control" id="category_image" name="category_image"
                                            accept="image/*" required>
                                        <div id="image-preview-container"
                                            style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="category_name" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-success">Create Category</button>
                                </form>
                            </div>
                        </div>
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
