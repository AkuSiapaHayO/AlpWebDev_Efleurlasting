@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edit Product - {{ $product->product_name }}</h1>

        <form action="{{ route('products.update', ['product' => $product]) }}" method="post" enctype="multipart/form-data"
            onsubmit="return validateColors(this)">
            @csrf
            @method('PUT') {{-- Use the PUT method for update --}}

            <div class="row">
                <div class="col-md-4">
                    {{-- Existing Images --}}
                    <div class="mb-4">
                        <label for="images" class="form-label">Product Images</label>
                        <input type="file" class="form-control" id="images" name="images[]"
                            accept="image/jpg, image/png, image/jpeg" multiple onchange="previewImages()">
                    </div>
                    <div id="product-images-preview">
                        {{-- Display existing images preview --}}
                        @foreach ($product->images as $image)
                            <img src="{{ asset('storage/' . $image->image_name) }}" class="img-fluid mt-3 col-sm-6 w-100"
                                alt="Product Image">
                        @endforeach
                    </div>
                </div>

                <div class="col-md-8">
                    {{-- Product --}}
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name"
                            value="{{ $product->product_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="" disabled>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->id == $product->category_id) selected @endif>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="row">
                        {{-- Existing Colors --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="colors" class="form-label">Colors</label>
                                <div id="color-inputs">
                                    @foreach ($colors as $color)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $color->id }}"
                                                name="selected_colors[]" @if (in_array($color->id, $checkedColors)) checked @endif>
                                            <label class="form-check-label" for="color_{{ $color->id }}">
                                                {{ $color->color_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-primary mt-2" onclick="addColorInput()">Add
                                    Color</button>
                            </div>
                        </div>

                        {{-- New Colors --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="newcolors" class="form-label">New Colors</label>
                                <div id="newcolor-inputs">
                                    <!-- Input container for dynamic string inputs -->
                                </div>
                                <button type="button" class="btn btn-primary mt-2" onclick="addNewColorInput()">Add
                                    Color</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Update Product</button>

            <!-- Delete Button -->
            <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete Product</button>

            <script>
                function confirmDelete() {
                    if (confirm('Are you sure you want to delete this product?')) {
                        // Assuming you have a route named 'products.destroy' for deleting a product
                        window.location.href = "{{ route('products.destroy', ['product' => $product]) }}";
                    }
                }
            </script>
        </form>
    </div>

    <script>
        function addNewColorInput() { // Updated function name
            const newColorInputsContainer = document.querySelector('#newcolor-inputs'); // Updated id to 'newcolor-inputs'
            const newColorInput = document.createElement('input'); // Fix: Change 'color' to 'input'

            newColorInput.type = 'text'; // Fix: Change 'newInput' to 'newColor'
            newColorInput.className = 'form-control mt-2';
            newColorInput.name = 'additional_newcolors[]'; // Updated name to 'additional_newcolors[]'
            newColorInput.placeholder = 'Enter additional color';

            newColorInputsContainer.appendChild(newColorInput);
        }

        function validateColors() {
            const existingColors = document.querySelectorAll('[name="selected_colors[]"]:checked');
            const newColors = document.querySelectorAll('[name="additional_newcolors[]"]');

            if (existingColors.length === 0 && newColors.length === 0) {
                alert('Please select at least one color.');
                return false; // Prevent form submission
            }

            return true; // Continue with form submission
        }

        function previewImages() {
            const imagesInput = document.querySelector('#images');
            const imagesPreview = document.querySelector('#product-images-preview');

            // Clear existing previews
            imagesPreview.innerHTML = '';

            // Counter to track the number of images
            let imageCount = 0;

            // Loop through selected files and generate previews
            for (const file of imagesInput.files) {
                // Check if two images have been added, if so, create a new row
                if (imageCount % 2 === 0) {
                    const rowDiv = document.createElement('div');
                    rowDiv.className = 'row mb-3';
                    imagesPreview.appendChild(rowDiv);
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.classList.add('img-fluid', 'mt-3', 'col-sm-6', 'w-100');

                    // Append the image to the last row div
                    const lastRowDiv = imagesPreview.lastChild;
                    lastRowDiv.appendChild(imgElement);
                };

                reader.readAsDataURL(file);

                // Increment the image count
                imageCount++;
            }
        }
    </script>
@endsection
