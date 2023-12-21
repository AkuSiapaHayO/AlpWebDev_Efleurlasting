@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card my-5 shadow-lg" style="border: none;">
            <div class="card-body">
                <h1 class="heading text-center">Your Cart</h1>
                <p class="text text-center mb-0">Check your items in your cart carefully</p>
            </div>
        </div>

        @php
            $totalAmount = 0;
        @endphp

        <div>
            <div class="card shadow-lg" style="border: none;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Color</th>
                                    <th>Quantity</th>
                                    <th>Note</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $cartItem)
                                    @php
                                        $productColor = \App\Models\ProductColor::find($cartItem->productcolor_id);
                                        $product = $productColor->product;
                                        $color = $productColor->color;
                                        $category = $product->category;
                                        $subtotal = $cartItem->quantity * $productColor->product->price;
                                        $totalAmount += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $category->category_name }} - {{ $product->product_name }}</td>
                                        <td>{{ $color->color_name }}</td>
                                        <td>{{ $cartItem->quantity }}</td>
                                        <td>{{ $cartItem->note }}</td>
                                        <td style="white-space: nowrap;">
                                            {{ 'Rp ' . number_format($productColor->product->price, 0, ',', '.') }}</td>
                                        <td style="white-space: nowrap;">{{ 'Rp ' . number_format($subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end"><strong>Total:</strong></td>
                                    <td style="white-space: nowrap;">{{ 'Rp ' . number_format($totalAmount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg my-5" style="border: none;">
                <div class="card-body" class="px-4 px-md-0">
                    <form action="{{ route('order.finalize') }}" method="get" class="row g-3">
                        @csrf
                        <div class="col-md-6">
                            <label for="delivery_date" class="form-label">Delivery Date</label>
                            <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="delivery_time" class="form-label">Delivery Time</label>
                            <input type="time" class="form-control" id="delivery_time" name="delivery_time" required>
                        </div>
                        <div class="col-md-6">
                            <label for="recipient_name" class="form-label">Recipient Name</label>
                            <input type="text" class="form-control" id="recipient_name" name="recipient_name"
                                value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="recipient_phone" class="form-label">Recipient Phone</label>
                            <input type="tel" class="form-control" id="recipient_phone" name="recipient_phone"
                                value="{{ Auth::user()->phone }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient_address" class="form-label">Recipient Address</label>
                            <input type="text" class="form-control" id="recipient_address" name="recipient_address"
                                value="{{ Auth::user()->address }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="deliverySelect" class="form-label">Select Delivery Option:</label>
                            <select class="form-select" id="deliverySelect" name="deliveryOption">
                                <option value='0' selected>Self Pickup (Citraland, Surabaya)</option>
                                <option value='1'>With Delivery (+Rp25k, Surabaya only)</option>
                            </select>
                        </div>
                        <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">
                        <input type="hidden" name="cartItemId" value="{{ implode(',', $cartItemsId) }}">
                        <button type="submit" class="btn btn-pink-color fw-bold text-white w-100 mt-2">Finalize
                            Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
