@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Your Cart</h1>

        @php
            $totalAmount = 0;
        @endphp

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
                            <td>{{ $productColor->product->price }}</td>
                            <td>{{ $subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end"><strong>Total:</strong></td>
                        <td>{{ 'Rp ' . number_format($totalAmount, 0, ',', '.') }}</td>
                        {{-- Louiss kalau aku belum gantiin semua tampilan ke Rupiah gantiin ya hhehehehe --}}
                    </tr>
                </tfoot>
            </table>

            <form action="{{ route('order.finalize') }}" method="get">
                @csrf
                <div class="mb-3">
                    <label for="delivery_date" class="form-label">Delivery Date</label>
                    <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
                </div>
                <div class="mb-3">
                    <label for="delivery_time" class="form-label">Delivery Time</label>
                    <input type="time" class="form-control" id="delivery_time" name="delivery_time" required>
                </div>
                <div class="mb-3">
                    <label for="recipient_name" class="form-label">Recipient Name</label>
                    <input type="text" class="form-control" id="recipient_name" name="recipient_name"
                        value="{{ Auth::user()->name }}" required>
                </div>
                <div class="mb-3">
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
                    <select class="form-select" id="deliverySelect" name="deliveryOption" onchange="updateTotalAmount()">
                        <option value="0" selected>No Delivery</option>
                        <option value="1">With Delivery (+$25.00)</option>
                    </select>
                </div>
                <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">
                <input type="hidden" name="cartItemId" value="{{ implode(',', $cartItemsId) }}">
                <button type="submit" class="btn btn-primary">Finalize Order</button>
            </form>
        </div>
    </div>
    <script>
        function updateTotalAmount() {
            var deliverySelect = document.getElementById('deliverySelect');
            var totalAmountInput = document.querySelector('input[name="totalAmount"]');

            // Get the selected value from the dropdown
            var selectedValue = parseFloat(deliverySelect.value);

            // Update the hidden input field with the new totalAmount
            var newTotalAmount = selectedValue === 1 ? {{ $totalAmount }} + 25000 : {{ $totalAmount }};
            totalAmountInput.value = newTotalAmount.toFixed(2); // Adjust the precision as needed
        }

        // Additional function to call updateTotalAmount initially if the dropdown has a pre-selected option on page load
        function initialize() {
            updateTotalAmount();
        }

        // Call the initialize function when the page is loaded
        window.onload = initialize;
    </script>
@endsection
