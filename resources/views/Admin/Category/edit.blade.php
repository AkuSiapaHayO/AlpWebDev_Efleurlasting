@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.categories.view') }}">
                    <button class="btn btn-outline-primary">Back</button>
                </a>
                <h1>Edit Category</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('category.update', ['category' => $category->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div style="width: 100%; height: 500px; overflow: hidden; position: relative;">
                                    @if (File::exists(public_path($category->category_image)))
                                        <img id="image-preview" src="{{ asset($category->category_image) }}"
                                            class="img-fluid img-thumbnail" alt="Category Image"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <img id="image-preview" src="{{ asset('Assets/Categories/' . $category->category_image) }}"
                                            class="img-fluid img-thumbnail" alt="Category Image"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif

                                </div>

                                {{-- Image upload --}}
                                <label for="category_image" class="form-label mt-2">Update Category Image</label>
                                <input type="file" class="form-control" id="category_image" name="category_image"
                                    accept="image/*">
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name"
                                    value="{{ $category->category_name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $category->description }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Update Category</button>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                                Delete Category
                            </button>
                        </div>
                    </div>

                </form>
                {{-- Delete Modal --}}
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this category? All Products related to this category will be
                                destroyed. Please be sure before deleting this category.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('category.destroy', ['category' => $category->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the file input element
        var input = document.getElementById('category_image');

        // Get the image preview element
        var preview = document.getElementById('image-preview');

        // Set the initial image source based on the current value of the file input
        preview.src = input.files && input.files.length > 0 ? URL.createObjectURL(input.files[0]) : preview.src;

        // Update the image preview when the file input changes
        input.addEventListener('change', function() {
            if (input.files && input.files.length > 0) {
                preview.src = URL.createObjectURL(input.files[0]);
            } else {
                // If no file is selected, show the default image
                preview.src = "{{ asset('Assets/Categories/default-image.jpg') }}";
            }
        });
    </script>
@endsection
