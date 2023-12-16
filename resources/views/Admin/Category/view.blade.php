@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('products.view') }}">
                    <button class="btn btn-outline-primary">Back</button>
                </a>
                <h1>Edit Categories</h1>
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionFlushExample">
                    {{-- Add New Category --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseNewCategory" aria-expanded="false"
                                aria-controls="collapseNewCategory">
                                Add New Category
                            </button>
                        </h2>
                        <div id="collapseNewCategory" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Create New Category</h5>
                                        <form action="{{ route('category.store') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="category_name" class="form-label">Category Name</label>
                                                <input type="text" class="form-control" id="category_name"
                                                    name="category_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-success">Create Category</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Display Categories --}}
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                        @foreach ($categories as $category)
                            <div class="col">
                                <div class="card w-100 h-100">
                                    @if (Storage::disk('public')->exists($category->category_image))
                                        <img src="{{ asset('storage/' . $category->category_image) }}" class="card-img-top"
                                            style="max-height:400px; object-fit:cover" alt="Category Image">
                                    @else
                                        <img src="{{ asset('Assets/Categories/' . $category->category_image) }}"
                                            class="card-img-top" style="max-height:400px; object-fit:cover" alt="Category Image">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title" style="height: 50px; overflow: hidden;">
                                            {{ $category->category_name }}
                                        </h5>
                                        <p class="card-text">{{ $category->description }}</p>
                                        <a href="{{ route('category.show', ['category' => $category->id]) }}"
                                            class="btn btn-sm btn-primary">View</a>
                                        <a href="{{ route('category.edit', ['category' => $category->id]) }}"
                                            class="btn btn-sm btn-secondary">Edit</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
