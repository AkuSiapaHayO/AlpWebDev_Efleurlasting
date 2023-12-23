@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="javascript:history.back()">
                    <button class="btn btn-outline-primary">Back</button>
                </a>
                <h1>Edit Product - {{ $product->product_name }}</h1>
            </div>

            <div class="card-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        {{-- Existing Images --}}
                        <label for="existingimages" class="form-label">Current Images</label>
                        <div id="product-images-preview" style="display: flex; flex-wrap: wrap; gap: 10px;">
                            {{-- Display existing images preview --}}
                            @foreach ($product->images as $image)
                                <div class="img-container position-relative"
                                    style="position: relative; width: 48%; height: 300px; margin-bottom: 10px;">
                                    @if (Storage::disk('public')->exists($image->image_name))
                                        <img src="{{ asset('storage/' . $image->image_name) }}"
                                            class="img-thumbnail w-100 h-100" alt="Product Image"
                                            style="object-fit: cover;">
                                    @else
                                        <img src="{{ asset('Assets/products/' . $image->image_name) }}"
                                            class="img-thumbnail w-100 h-100" alt="Product Image"
                                            style="object-fit: cover;">
                                    @endif

                                    <!-- Delete button form -->
                                    <form action="{{ route('image.delete', ['image' => $image->id]) }}" method="POST"
                                        class="position-absolute bottom-0 end-0 m-2">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        <form action="{{ route('image.store', ['product' => $product]) }}" method="post"
                            enctype="multipart/form-data" onsubmit="return validateColors(this)">
                            @csrf
                            @method('POST')

                            {{-- Add New Image --}}
                            <div class="mb-4">
                                <label for="images" class="form-label">Add New Images</label>
                                <input type="file" class="form-control" id="images" name="images[]"
                                    accept="image/jpg, image/png, image/jpeg" multiple onchange="previewImages()">
                            </div>

                            {{-- If you need to associate the image with a product, include a product_id input --}}
                            <input type="hidden" name="product_id" value="{{ $product->id }}"> {{-- Replace this with the actual product ID --}}

                            <div id="image-preview-container" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>

                            <button type="submit" class="btn btn-success mt-3">Upload Images</button>
                        </form>

                    </div>

                    <div class="col-md-8">
                        <form action="{{ route('products.update', ['product' => $product]) }}" method="post"
                            enctype="multipart/form-data" onsubmit="return validateColors(this)">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-10">
                                    {{-- Product --}}
                                    <div class="mb-3">
                                        <label for="product_name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name"
                                            value="{{ $product->product_name }}" required>
                                    </div>
                                </div>
                                {{-- Is Active --}}
                                <div class="col-md-2">
                                    <div class="mb-3" style="padding-top: 2rem;">
                                        <div class="form-check form-switch mx-2">
                                            <!-- Actual checkbox -->
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                                name="is_active" {{ $product->is_active ? 'checked' : '' }}
                                                style="transform: scale(1.8);">

                                            <!-- Label for the checkbox -->
                                            <label class="form-check-label" for="is_active"
                                                style="padding-left: 10px;">Active</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="is_active_input"
                                            name="is_active_input" disabled hidden>
                                    </div>
                                </div>



                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $product->description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="size" class="form-label">Size</label>
                                <input type="text" class="form-control" id="size" name="size"
                                    value="{{ $product->size }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ $product->price }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="" disabled>Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == $product->category_id) selected @endif>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Choose Colors</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{-- Existing Colors --}}
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="colors" class="form-label">Colors</label>
                                                <div id="color-inputs">
                                                    @foreach ($colors as $color)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $color->id }}" name="selected_colors[]"
                                                                @if (in_array($color->id, $checkedColors)) checked @endif>
                                                            <label class="form-check-label"
                                                                for="color_{{ $color->id }}">
                                                                {{ $color->color_name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        {{-- New Colors --}}
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="newcolors" class="form-label">New Colors</label>
                                                <div id="newcolor-inputs">
                                                    <!-- Input container for dynamic string inputs -->
                                                </div>
                                                <button type="button" class="btn btn-primary mt-2"
                                                    onclick="addNewColorInput()">Add
                                                    Color</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Update Product</button>
                        </form>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-end">
                    {{-- Update Button --}}

                    <button type="button" class="btn btn-danger mt-2" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">
                        Delete Category
                    </button>

                    {{-- Delete Modal --}}
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this product? All Images, and Cart Items of customers
                                    will be destroyed. Please be sure before deleting this category.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('products.destroy', ['product' => $product->id]) }}"
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
    </div>

    <script>
        function addNewColorInput() {
            const newColorInputsContainer = document.querySelector('#newcolor-inputs');
            const newColorInput = document.createElement('input');

            newColorInput.type = 'text';
            newColorInput.className = 'form-control mt-2';
            newColorInput.name = 'additional_newcolors[]';
            newColorInput.placeholder = 'Enter additional color';

            newColorInputsContainer.appendChild(newColorInput);
        }

        function validateColors() {
            const existingColors = document.querySelectorAll('[name="selected_colors[]"]:checked');
            const newColors = document.querySelectorAll('[name="additional_newcolors[]"]');

            if (existingColors.length === 0 && newColors.length === 0) {
                alert('Please select at least one color.');
                return false;
            }

            return true;
        }

        function previewImages() {
            var input = document.getElementById('images');

            var previewContainer = document.getElementById('image-preview-container');

            previewContainer.innerHTML = '';

            for (var i = 0; i < input.files.length; i++) {
                var file = input.files[i];

                if (file && file.type.startsWith('image/')) {

                    var img = document.createElement('img');
                    img.className = 'img-thumbnail';
                    img.style.width = '48%';
                    img.style.height = '300px';
                    img.style.objectFit = 'cover';

                    img.src = URL.createObjectURL(file);

                    previewContainer.appendChild(img);
                }
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const is_activeCheckbox = document.getElementById('is_active');
            const is_activeInput = document.getElementById('is_active_input');

            // Initial check to set the state on page load
            is_activeInput.disabled = !is_activeCheckbox.checked;

            // Add an event listener to the checkbox
            is_activeCheckbox.addEventListener('change', function() {
                // Update the disabled attribute based on the checkbox state
                is_activeInput.disabled = !this.checked;
            });
        });
    </script>
@endsection
