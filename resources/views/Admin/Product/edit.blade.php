@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="card shadow-lg my-3 my-md-4" style="border: none;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <a href="javascript:history.back()">
                        <button class="btn btn-pink-color fw-bold text-white">Back</button>
                    </a>
                    <h1 class="heading mx-auto mb-0">Edit Product</h1>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-lg mb-3" style="border: none;">
                        <div class="card-body">
                            <label for="existingimages" class="form-label heading borders-left fs-3 mb-0">Current
                                Images</label>
                        </div>
                    </div>
                    <div class="card shadow-lg mb-3" style="border: none;">
                        <div class="card-body">
                            <div id="product-images-preview" style="display: flex; flex-wrap: wrap; gap: 10px;">
                                @foreach ($product->images as $image)
                                    <div class="img-container position-relative"
                                        style="position: relative; width: 48%; height: 300px; margin-bottom: 10px;">
                                        @if (File::exists(public_path($image->image_name)))
                                            <img src="{{ asset($image->image_name) }}"
                                                class="img-thumbnails w-100 h-100 shadow-lg" alt="Product Image"
                                                style="object-fit: cover;">
                                        @else
                                            <img src="{{ asset('Assets/Products/' . $image->image_name) }}"
                                                class="img-thumbnails w-100 h-100 shadow-lg" alt="Product Image"
                                                style="object-fit: cover;">
                                        @endif
                                        <form action="{{ route('image.delete', ['image' => $image->id]) }}" method="POST"
                                            class="position-absolute bottom-0 end-0 m-2">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg mb-3" style="border: none;">
                        <div class="card-body">
                            <form action="{{ route('image.store', ['product' => $product]) }}" method="post"
                                enctype="multipart/form-data" onsubmit="return validateColors(this)">
                                @csrf
                                @method('POST')
                                <div class="">
                                    <label for="images" class="form-label heading borders-left fs-3 mb-3">Add New
                                        Images</label>
                                    <input type="file" class="form-control" id="images" name="images[]"
                                        accept="image/jpg, image/png, image/jpeg" multiple onchange="previewImages()">
                                </div>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div id="image-preview-container" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                                <button type="submit" class="btn btn-pink-color fw-bold text-white mt-3">Upload
                                    Images</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-lg mb-3" style="border: none;">
                        <div class="card-body">
                            <h1 class="heading borders-left mb-0 fs-3">Product Data</h1>
                        </div>
                    </div>
                    <form action="{{ route('products.update', ['product' => $product]) }}" method="post"
                        enctype="multipart/form-data" onsubmit="return validateColors(this)" class="mb-3">
                        @csrf
                        @method('put')
                        <div class="card shadow-lg mb-3" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="product_name" class="form-label">Product Name</label>
                                    </div>
                                    <div class="col-md-10 mb-3 d-flex align-items-center">
                                        <input type="text" class="form-control" id="product_name" name="product_name"
                                            value="{{ $product->product_name }}" required>
                                    </div>
                                    <div class="col-md-2 mb-3 d-flex align-items-center">
                                        <div class="ps-5 form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                                name="is_active" {{ $product->is_active ? 'checked' : '' }}
                                                style="transform: scale(1.8);">

                                            <label class="form-check-label" for="is_active"
                                                style="padding-left: 10px;">Active</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="is_active_input"
                                            name="is_active_input" disabled hidden>
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
                            </div>
                        </div>
                        <div class="card shadow-lg mb-3" style="border: none;">
                            <div class="card-body">
                                <h1 class="heading borders-left mb-0 fs-3">Colors</h1>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="card shadow-lg mb-3 mb-md-0" style="border: none;">
                                    <div class="card-body">
                                        <label for="colors" class="form-label fw-bold fs-5">Current
                                            Colors</label>
                                        <div id="color-inputs">
                                            @foreach ($colors as $color)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $color->id }}" name="selected_colors[]"
                                                        @if (in_array($color->id, $checkedColors)) checked @endif>
                                                    <label class="form-check-label" for="color_{{ $color->id }}">
                                                        {{ $color->color_name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-lg" style="border: none;">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <label for="newcolors" class="form-label fw-bold fs-5">New Colors</label>
                                        <div id="newcolor-inputs">
                                        </div>
                                        <button type="button" class="btn btn-pink-color fw-bold text-white w-100 mt-2"
                                            onclick="addNewColorInput()">Add
                                            Color</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-lg" style="border: none;">
                            <div class="card-body">
                                <button type="submit" class="btn btn-pink-color fw-bold text-white w-100">Update
                                    Product</button>
                            </div>
                        </div>
                    </form>
                    <div class="card shadow-lg mb-3" style="border: none;">
                        <div class="card-body">
                            <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                                Delete Product
                            </button>
                        </div>
                    </div>
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
                                    Are you sure you want to delete this product? All Images, and Cart Items of
                                    customers
                                    will be destroyed. Please be sure before deleting this product.
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
    </section>

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
                    img.className = 'img-thumbnails';
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

            is_activeInput.disabled = !is_activeCheckbox.checked;

            is_activeCheckbox.addEventListener('change', function() {
                is_activeInput.disabled = !this.checked;
            });
        });
    </script>
@endsection
