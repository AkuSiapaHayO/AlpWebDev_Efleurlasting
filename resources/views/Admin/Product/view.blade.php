@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="card shadow-lg my-3 my-md-4" style="border: none;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.setting') }}">
                        <button class="btn btn-pink-color fw-bold text-white">Back</button>
                    </a>
                    <h1 class="heading mx-auto mb-0">Edit Products</h1>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="row mb-3 mb-md-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="card shadow-lg" style="border: none;">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed p-0" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            Categories
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p>
                                                Manage all your product categories in one place. Create, update,
                                                and delete
                                                categories easily with
                                                this section. </p>
                                            <a href="{{ route('admin.categories.view') }}" class="card-link">
                                                <button class="btn btn-pink-color text-white fw-bold">Manage
                                                    Categories</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-lg" style="border: none;">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed p-0" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                            aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Colors
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p>
                                                Explore all available colors for your products. Manage and update
                                                color options
                                                effortlessly in
                                                this section. </p>
                                            <a href="{{ route('colors.view') }}" class="card-link">
                                                <button class="btn btn btn-pink-color text-white fw-bold">Manage
                                                    Colors</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="card shadow-lg mb-4" style="border: none;">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-between align-items-center">
                        <h1 class="my-3 heading">All Products</h1>
                        <a href="{{ route('products.create') }}" class="btn btn-pink-color fw-bold text-white mb-3 w-100"
                            style="max-width: 400px">Add New
                            Product</a>
                    </div>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                        @foreach ($products as $product)
                            <div class="col mb-4">
                                <div class="card h-100 shadow-lg new" style="transition: 0.3s; border-radius: 7px;">
                                    @if (File::exists(public_path($product->images->first()->image_name)))
                                        <img src="{{ asset($product->images->first()->image_name) }}" class="d-block w-100"
                                            alt="..." style="height: 300px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('Assets/Products/' . $product->images->first()->image_name) }}"
                                            class="d-block w-100" alt="..."
                                            style="height: 300px; object-fit: cover;">
                                    @endif
                                    <div class="card-body">
                                        <p class="heading">
                                            {{ $product->category->category_name }} <br> -{{ $product->product_name }}
                                        </p>
                                        <p class="text fs-5">
                                            {{ $product->is_active ? 'Product is Active' : 'Product is Inactive' }}
                                        </p>
                                        <a href="{{ route('products.show', ['product' => $product->id]) }}"
                                            class="btn btn-pink-color fw-bold text-white w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
