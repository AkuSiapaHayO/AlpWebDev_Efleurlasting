@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="card my-3 my-md-4 shadow-lg" style="border: none;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <a href="{{ route('products.view') }}">
                        <button class="btn btn-pink-color fw-bold text-white">Back</button>
                    </a>
                    <h1 class="mx-auto heading mb-0">Create New Product</h1>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data"
                onsubmit="return validateColors(this)">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-lg mb-3" style="border: none;">
                            <div class="card-body">
                                <label for="images" class="form-label heading borders-left fs-3 mb-0">Product
                                    Images</label>
                            </div>
                        </div>
                        <div class="card shadow-lg mb-3" style="border: none;">
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="file" name="images[]" id="images" class="form-control"
                                        accept="image/jpg, image/png, image/jpeg" multiple onchange="previewImages()">
                                </div>
                                <div id="image-preview-container" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow-lg mb-3" style="border: none;">
                            <div class="card-body">
                                <h1 class="heading fs-3 borders-left mb-0">New Product Form</h1>
                            </div>
                        </div>
                        <div class="card shadow-lg mb-3" style="border: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="product_name" class="form-label">Product Name</label>
                                    </div>
                                    <div class="col-md-10 d-flex align-items-center">
                                        <input type="text" class="form-control" id="product_name" name="product_name"
                                            required>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center">
                                        <div class="ps-5 form-check form-switch mx-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                                name="is_active" checked style="transform: scale(1.8);">

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
                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="size" class="form-label">Size</label>
                                            <input type="text" class="form-control" id="size" name="size"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" class="form-control" id="price" name="price"
                                                required>
                                        </div>
                                    </div>
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
                            </div>
                        </div>
                        <div class="card shadow-lg mb-3" style="border: none;">
                            <div class="card-body">
                                <h1 class="heading fs-3 borders-left mb-0">Choose Colors</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card shadow-lg mb-3" style="border: none;">
                                    <div class="card-body">
                                        <label for="colors" class="form-label fw-bold fs-5">Available Colors</label>
                                        <div id="color-inputs">
                                            @foreach ($colors as $color)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $color->id }}" name="selected_colors[]">
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
                                <div class="card shadow-lg mb-3" style="border: none;">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <label for="newcolors" class="form-label fw-bold fs-5">New Colors</label>
                                        <div id="newcolor-inputs">
                                        </div>
                                        <button type="button" class="btn btn-pink-color text-white fw-bold w-100"
                                            onclick="addNewColorInput()">Add
                                            Color</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-lg mb-3" style="border: none;">
                            <div class="card-body">
                                <button type="submit" class="btn btn-pink-color text-white fw-bold w-100">Create
                                    Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

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
            console.log('newColors', newColors);
            console.log('existingColors', existingColors);

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

        $(function() {
            $('[data-toggle="switch"]').bootstrapSwitch();
        });
    </script>
@endsection
