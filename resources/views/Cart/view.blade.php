@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Your Cart</h1>

        @if ($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            @php
                $totalAmount = 0;
            @endphp
            <form action="{{ route('checkout.create') }}" method="get">
                @csrf
                {{-- @method('get') --}}
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                    @foreach ($cartItems as $cartItem)
                        @php
                            $productColor = \App\Models\ProductColor::find($cartItem->productcolor_id);
                            $product = $productColor->product;
                            $color = $productColor->color;
                            $category = $product->category;
                        @endphp

                        <div class="col mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cartItem{{ $cartItem->id }}"
                                            name="selectedCartItems[]" value="{{ $cartItem->id }}">
                                        <label class="form-check-label" for="cartItem{{ $cartItem->id }}">
                                            <h5 class="card-title">
                                                {{ $category->category_name }} - {{ $product->product_name }}
                                            </h5>
                                        </label>
                                    </div>

                                    {{-- Display the first image of the product --}}
                                    @if ($product->images->isNotEmpty() && Storage::disk('public')->exists($product->images->first()->image_name))
                                        <img src="{{ asset('storage/' . $product->images->first()->image_name) }}"
                                            class="d-block w-100 img-thumbnail" alt="Product Image"
                                            style="height: 40vh; max-width: 100vw; object-fit: cover;">
                                    @else
                                        {{-- Display a placeholder image from the Asset/products/ path when no image is available --}}
                                        @if ($product->images->isNotEmpty())
                                            <img src="{{ asset('Assets/products/' . $product->images->first()->image_name) }}"
                                                alt="Product Image" class="card-img-top img-fluid img-thumbnail"
                                                style="height: 40vh; max-width: 100vw; object-fit: cover;">
                                        @else
                                            {{-- Display a placeholder image or text when no image is available --}}
                                            <div class="card-img-top d-flex align-items-center justify-content-center"
                                                style="height: 40vh; background: rgba(255, 255, 255, 0.7);">
                                                <p class="text-muted">No image available</p>
                                            </div>
                                        @endif
                                    @endif

                                    <table class="table mt-3">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Color</th>
                                                <td>{{ $color->color_name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Quantity</th>
                                                <td>{{ $cartItem->quantity }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Note</th>
                                                <td>{{ $cartItem->note }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Price</th>
                                                <td>Rp {{ number_format($productColor->product->price, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Total</th>
                                                <td>Rp {{ number_format($cartItem->quantity * $productColor->product->price, 0, ',', '.') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    {{-- Update and Delete buttons --}}
                                    <div class="d-flex justify-content-between mt-3">
                                        <!-- Update Button - Trigger Modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#updateModal{{ $cartItem->id }}">
                                            Update
                                        </button>

                                        <!-- Delete Button - Trigger Modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $cartItem->id }}">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <button type="submit" class="btn btn-success">Proceed to Checkout</button>
            </form>
        @endif
        @foreach ($cartItems as $cartItem)
            {{-- Update Modal --}}
            <div class="modal fade" id="updateModal{{ $cartItem->id }}" tabindex="-1" role="dialog"
                aria-labelledby="updateModalLabel{{ $cartItem->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel{{ $cartItem->id }}">Update Cart Item
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add your update form fields here -->
                            <form action="{{ route('cartitem.update', ['cartitem' => $cartItem->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <!-- Your form fields go here -->
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

            {{-- Delete Modal --}}
            <div class="modal fade" id="deleteModal{{ $cartItem->id }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalLabel{{ $cartItem->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $cartItem->id }}">Delete Cart Item
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
        @endforeach
    </div>

@endsection
