@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <button type="button" class="btn btn-secondary" onclick="goBack()">Back</button>

        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>User</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Delivery Date</td>
                        <td>{{ $deliveryDate }}</td>
                    </tr>
                    <tr>
                        <td>Delivery Time</td>
                        <td>{{ $deliveryTime }}</td>
                    </tr>
                    <tr>
                        <td>Recipient Name</td>
                        <td>{{ $recipientName }}</td>
                    </tr>
                    <tr>
                        <td>Recipient Phone</td>
                        <td>{{ $recipientPhone }}</td>
                    </tr>
                    <tr>
                        <td>Recipient Address</td>
                        <td>{{ $recipientAddress }}</td>
                    </tr>
                    <tr>
                        <td>Notes</td>
                        <td>{{ $notes }}</td>
                    </tr>
                    <tr>
                        <td>Is Delivery</td>
                        <td>{{ $isDelivery ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td>{{ 'Rp ' . number_format($totalAmount, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">
            Continue to Payment
        </button>
        {{-- Payment Modal --}}
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('order.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Payment details and file upload input -->
                            <div class="mb-3">
                                <label for="paymentDetails" class="form-label">Payment Details</label>
                                <textarea class="form-control" id="paymentDetails" name="paymentDetails" rows="3" placeholder="Enter payment details" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="uploadImage" class="form-label">Upload Image</label>
                                <input type="file" class="form-control" id="uploadImage" name="uploadImage" required>
                            </div>

                            <!-- Hidden inputs for form submission -->
                            <input type="hidden" name="order_date" value="{{ now() }}">
                            <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
                            <input type="hidden" name="delivery_date" value="{{ $deliveryDate }}">
                            <input type="hidden" name="delivery_time" value="{{ $deliveryTime }}">
                            <input type="hidden" name="recipient_name" value="{{ $recipientName }}">
                            <input type="hidden" name="recipient_phone" value="{{ $recipientPhone }}">
                            <input type="hidden" name="recipient_address" value="{{ $recipientAddress }}">
                            <input type="hidden" name="notes" value="{{ $notes }}">
                            <input type="hidden" name="isDelivery" value="{{ $isDelivery }}">
                            <input type="hidden" name="cartItemId" value="{{ implode(',', $cartItemsId) }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit Payment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
