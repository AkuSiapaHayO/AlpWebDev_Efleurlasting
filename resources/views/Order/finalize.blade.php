@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="card my-4 my-md-3 shadow-lg" style="border: none;">
                <div class="card-body d-flex justify-content-between">
                    <button type="button" class="btn btn-pink-color fw-bold text-white" onclick="goBack()">Back</button>
                    <h1 class="heading text-center mx-auto my-0">Finalize your Order</h1>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="card shadow-lg" style="border: none;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Order Information</th>
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
                                    <td>Total Amount Before Delivery</td>
                                    <td>{{ 'Rp ' . number_format($totalAmountBeforeDelivery, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Delivery Fee</td>
                                    <td>{{ 'Rp ' . number_format($deliveryFee, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Total Amount</td>
                                    <td>{{ 'Rp ' . number_format($totalAmount, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-pink-color fw-bold text-white w-100" data-bs-toggle="modal"
                        data-bs-target="#paymentModal">
                        Continue to Payment
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section>
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
                            <div class="mb-3">
                                <label for="paymentDetails" class="form-label">Payment Details</label>
                                <textarea class="form-control" id="paymentDetails" name="paymentDetails" rows="3"
                                    placeholder="Example: a.n Karyna Budi" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="uploadImage" class="form-label">Upload SS Bukti Transfer</label>
                                <input type="file" class="form-control" id="uploadImage" name="uploadImage" accept="image/jpg, image/png, image/jpeg" required>
                            </div>

                            <input type="hidden" name="order_date" value="{{ now() }}">
                            <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
                            <input type="hidden" name="delivery_date" value="{{ $deliveryDate }}">
                            <input type="hidden" name="delivery_time" value="{{ $deliveryTime }}">
                            <input type="hidden" name="recipient_name" value="{{ $recipientName }}">
                            <input type="hidden" name="recipient_phone" value="{{ $recipientPhone }}">
                            <input type="hidden" name="recipient_address" value="{{ $recipientAddress }}">
                            <input type="hidden" name="notes" value="{{ $notes }}">
                            <input type="hidden" name="isDelivery" value="{{ $isDelivery }}"
                                placeholder="{{ $isDelivery }}">
                            <input type="hidden" name="cartItemId" value="{{ implode(',', $cartItemsId) }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-pink-color fw-bold text-white">Submit Payment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
