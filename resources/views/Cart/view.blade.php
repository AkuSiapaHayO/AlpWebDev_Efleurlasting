@extends('layouts.app')

@section('content')
    @if ($cartItems->isEmpty())
        <section>
            <div class="position-relative">
                <img src="{{ asset('Assets/About/AboutImage1.jpg') }}" class="vw-100 img-fluid"
                    style="object-fit: cover; max-height: 35vh; z-index: 0;" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100"
                    style="z-index: 1; background-color: rgba(255, 255, 255, 0.7)"></div>
                <div class="position-absolute bottom-0 start-0 w-100 px-5 py-5 d-none d-md-block" style="z-index: 2;">
                    <div class="d-flex flex-column align-items-center justify-content-center mb-5">
                        <h1 class="heading borders-left" style="font-size: 60px;">Checkout items <br> in your Cart</h1>
                    </div>
                </div>
            </div>
            <section>
                <div class="container-lg my-10">
                    <div class="my-3 my-md-4">
                        <p class="text text-center mb-0">Your Cart is currently Empty.</p>
                    </div>
                </div>
            </section>
        </section>
    @else
    {{-- NOT RESPONSIVE  --}}
        @php
            $totalAmount = 0;
        @endphp
        <section>
            <div class="position-relative">
                <img src="{{ asset('Assets/About/AboutImage1.jpg') }}" class="vw-100 img-fluid"
                    style="object-fit: cover; max-height: 35vh; z-index: 0;" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100"
                    style="z-index: 1; background-color: rgba(255, 255, 255, 0.7)"></div>
                <div class="position-absolute bottom-0 start-0 w-100 px-5 py-5 d-none d-md-block" style="z-index: 2;">
                    <div class="d-flex flex-column align-items-center justify-content-center mb-5">
                        <h1 class="heading borders-left" style="font-size: 60px;">Checkout items <br> in your Cart</h1>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container-lg my-10">
                <div class="my-3 my-md-4">
                    <p class="text text-center mb-0">Don't forget to check the items that you want to checkout!</p>
                </div>
            </div>

        </section>

        <section>
            <div class="container-sm px-5">
                <div class="shadow-lg rounded">
                    <form action="{{ route('checkout.create') }}" method="get">
                        @csrf
                        @foreach ($cartItems as $cartItem)
                            @php
                                $productColor = \App\Models\ProductColor::find($cartItem->productcolor_id);
                                $product = $productColor->product;
                                $color = $productColor->color;
                                $category = $product->category;
                            @endphp
                            <div class="col my-2 px-3">
                                <div class="card h-100" style="border: none;">
                                    <div class="card-body h-100">
                                        <div class="row">
                                            <div class="col-2">
                                                @if ($product->images->isNotEmpty() && Storage::disk('public')->exists($product->images->first()->image_name))
                                                    <img src="{{ asset('storage/' . $product->images->first()->image_name) }}"
                                                        class="img-fluid shadow-lg" alt="Product Image"
                                                        style="max-height: 300px; object-fit: cover;">
                                                @else
                                                    @if ($product->images->isNotEmpty())
                                                        <img src="{{ asset('Assets/products/' . $product->images->first()->image_name) }}"
                                                            alt="Product Image" class="img-fluid shadow-lg"
                                                            style="max-height: 300px; object-fit: cover;">
                                                    @else
                                                        <div class="img-fluid shadow-lg w-100"
                                                            style="max-height: 300px; background: rgba(255, 255, 255, 0.7);">
                                                            <p class="text-muted">No image available</p>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="col-7 mt-3 px-5">
                                                <p class="heading fs-2 mb-1 fs-6">
                                                    {{ $category->category_name }} - {{ $product->product_name }}
                                                </p>
                                                <div class="row">

                                                </div>
                                                <p class="text-secondary fw-bold mb-0 text-uppercase">Color</p>
                                                <p class="fw-medium">{{ $color->color_name }}</p>
                                                <p class="text-secondary fw-bold mb-0 text-uppercase">Quantity</p>
                                                <p class="fw-medium">{{ $cartItem->quantity }}</p>
                                                <p class="text-secondary fw-bold mb-0 text-uppercase">Note</p>
                                                <p class="fw-medium">{{ $cartItem->note }}</p>
                                            </div>
                                            <div class="col-2 pt-5">
                                                <div class="mb-3">
                                                    <p class="text-secondary fw-bold mb-0 text-uppercase">Total</p>
                                                    <p class="fw-medium">Rp
                                                        {{ number_format($cartItem->quantity * $productColor->product->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <button type="button"
                                                        class="btn btn-pink-color w-100 fw-bold text-white mb-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#updateModal{{ $cartItem->id }}">
                                                        Update Item
                                                    </button>

                                                    <button type="button" class="btn btn-danger w-100 fw-bold text-white"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $cartItem->id }}">
                                                        Delete Item
                                                    </button>
                                                </div>
                                                <div class="form-check mt-3">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="cartItem{{ $cartItem->id }}" name="selectedCartItems[]"
                                                        value="{{ $cartItem->id }}">
                                                    <label class="form-check-label" for="cartItem{{ $cartItem->id }}">
                                                        <p class="fw-bold m-0">
                                                            Checkout
                                                        </p>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mb-5 border-top">
                            <div class="px-5 py-3">
                                <button type="submit" class="btn btn-pink-color text-white fw-bold w-100">Proceed to
                                    Checkout</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>


        {{-- <section>
            <div class="container-lg">
                <form action="{{ route('checkout.create') }}" method="get">
                    @csrf
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                        @foreach ($cartItems as $cartItem)
                            @php
                                $productColor = \App\Models\ProductColor::find($cartItem->productcolor_id);
                                $product = $productColor->product;
                                $color = $productColor->color;
                                $category = $product->category;
                            @endphp
                            <div class="col mb-4">
                                <div class="card shadow-lg h-100" style="border: none;">
                                    <div class="card-body h-100">
                                        <div class="h-100 d-flex flex-column justify-content-between">
                                            <div>
                                                <div>
                                                    @if ($product->images->isNotEmpty() && Storage::disk('public')->exists($product->images->first()->image_name))
                                                        <img src="{{ asset('storage/' . $product->images->first()->image_name) }}"
                                                            class="img-fluid shadow-lg w-100" alt="Product Image"
                                                            style="max-height: 300px; object-fit: cover;">
                                                    @else
                                                        @if ($product->images->isNotEmpty())
                                                            <img src="{{ asset('Assets/products/' . $product->images->first()->image_name) }}"
                                                                alt="Product Image" class="img-fluid shadow-lg w-100"
                                                                style="max-height: 300px; object-fit: cover;">
                                                        @else
                                                            <div class="img-fluid shadow-lg w-100"
                                                                style="max-height: 300px; background: rgba(255, 255, 255, 0.7);">
                                                                <p class="text-muted">No image available</p>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mt-3 px-2">

                                                    <p class="sub-heading text-secondary mb-1 fs-6">
                                                        {{ $category->category_name }}
                                                    </p>
                                                    <h1 class="heading mb-2 fs-2 border-bottom pb-1">
                                                        {{ $product->product_name }}
                                                    </h1>
                                                    <p class="text-secondary fw-bold mb-0 text-uppercase">Color</p>
                                                    <p class="fw-medium">{{ $color->color_name }}</p>
                                                    <p class="text-secondary fw-bold mb-0 text-uppercase">Quantity</p>
                                                    <p class="fw-medium">{{ $cartItem->quantity }}</p>
                                                    <p class="text-secondary fw-bold mb-0 text-uppercase">Note</p>
                                                    <p class="fw-medium">{{ $cartItem->note }}</p>
                                                    <p class="text-secondary fw-bold mb-0 text-uppercase">Price</p>
                                                    <p class="fw-medium">Rp
                                                        {{ number_format($productColor->product->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="px-2 mt-2">
                                                <div class="mb-3">
                                                    <p class="text-secondary fw-bold mb-0 text-uppercase">Total</p>
                                                    <p class="fw-medium">Rp
                                                        {{ number_format($cartItem->quantity * $productColor->product->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <button type="button"
                                                        class="btn btn-pink-color w-100 fw-bold text-white mb-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#updateModal{{ $cartItem->id }}">
                                                        Update Item
                                                    </button>

                                                    <button type="button" class="btn btn-danger w-100 fw-bold text-white"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $cartItem->id }}">
                                                        Delete Item
                                                    </button>
                                                </div>
                                                <div class="form-check mt-3">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="cartItem{{ $cartItem->id }}" name="selectedCartItems[]"
                                                        value="{{ $cartItem->id }}">
                                                    <label class="form-check-label" for="cartItem{{ $cartItem->id }}">
                                                        <p class="fw-bold m-0">
                                                            Checkout
                                                        </p>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-5">
                        <div class="card shadow-lg" style="border: none;">
                            <div class="card-body">
                                <button type="submit" class="btn btn-pink-color text-white fw-bold w-100">Proceed to
                                    Checkout</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section> --}}
    @endif

    @foreach ($cartItems as $cartItem)
        <section>
            <div class="modal fade" id="updateModal{{ $cartItem->id }}" tabindex="-1" role="dialog"
                aria-labelledby="updateModalLabel{{ $cartItem->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel{{ $cartItem->id }}">Update Cart Item
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('cartitem.update', ['cartitem' => $cartItem->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        value="{{ $cartItem->quantity }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="note">Note:</label>
                                    <textarea class="form-control" id="note" name="note" rows="3">{{ $cartItem->note }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="modal fade" id="deleteModal{{ $cartItem->id }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalLabel{{ $cartItem->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $cartItem->id }}">Delete Cart Item
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this item?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('cartitem.delete', ['cartitem' => $cartItem->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection
