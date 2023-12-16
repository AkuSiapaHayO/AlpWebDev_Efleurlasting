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
                                <h5 class="card-title">
                                    {{ $category->category_name }} - {{ $product->product_name }}
                                </h5>
                                <p class="card-text">Color: {{ $color->color_name }}</p>
                                <p class="card-text">Quantity: {{ $cartItem->quantity }}</p>
                                <p class="card-text">Note: {{ $cartItem->note }}</p>
                                <p class="card-text">
                                    Price:
                                    {{ $productColor->product->price }}
                                    @php
                                        $totalAmount += $cartItem->quantity * $productColor->product->price;
                                    @endphp
                                </p>

                                <p class="card-text">
                                    <strong>Total:</strong> {{ $cartItem->quantity * $productColor->product->price }}
                                </p>

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

                    {{-- Update Modal --}}
                    <div class="modal fade" id="updateModal{{ $cartItem->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="updateModalLabel{{ $cartItem->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel{{ $cartItem->id }}">Update Cart Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add your update form fields here -->
                                    <form action="{{ route('cartitem.update', ['cartitem' => $cartItem->id]) }}"
                                        method="post">
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
                                            <textarea class="form-control" id="note" name="note"
                                                rows="3">{{ $cartItem->note }}</textarea>
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
                                    <h5 class="modal-title" id="deleteModalLabel{{ $cartItem->id }}">Delete Cart Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this item?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('cartitem.delete', ['cartitem' => $cartItem->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Display the total amount using the $totalAmount variable --}}
            <p>Total: {{ $totalAmount }}</p>
        @endif
    </div>
@endsection
