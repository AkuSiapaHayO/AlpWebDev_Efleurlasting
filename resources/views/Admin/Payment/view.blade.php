@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.setting') }}">
                    <button class="btn btn-outline-primary">Back</button>
                </a>
                <h1>Approve Payment</h1>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            <th>Payment Details</th>
                            <th>Payment Status</th>
                            <th>Transfer Evidence Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order['order_date'] }}</td>
                                <td>Rp {{ number_format($order['total_amount'], 0, ',', '.') }}</td>
                                <td>{{ $order['payment_details'] }}</td>
                                <td>
                                    @if ($order['payment_details'])
                                        Payment Unapproved
                                    @else
                                        Payment Approved
                                    @endif
                                </td>

                                <td>
                                    @if (Storage::disk('public')->exists($order->transfer_evidence_img))
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#imageModal{{ $order->id }}">
                                            <img src="{{ asset('storage/' . $order->transfer_evidence_img) }}"
                                                alt="Transfer Evidence" class="card-img-top img-fluid"
                                                style="width: 30vh; object-fit: cover; cursor: pointer;">
                                        </a>
                                    @else
                                        <p class="text-muted">No image available</p>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('payment.show', ['order' => $order->id]) }}"
                                        class="btn btn-outline-primary d-block mb-2">View More</a>
                                    <a href="#" class="btn btn-success d-block mb-2" data-bs-toggle="modal"
                                        data-bs-target="#approveModal{{ $order->id }}"
                                        data-order-id="{{ $order->id }}">Approve</a>
                                    <a href="#" class="btn btn-danger d-block" data-bs-toggle="modal"
                                        data-bs-target="#disapproveModal{{ $order->id }}"
                                        data-order-id="{{ $order->id }}">Disapprove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @foreach ($orders as $order)
        <!-- Modal for Approve -->
        <div class="modal fade" id="approveModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="approveModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel{{ $order->id }}">Approve Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to approve this payment?</p>
                        <p>You won't be able to update this anymore, please be sure before approving this payment.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('payment.approve', ['order' => $order->id]) }}"
                            class="btn btn-success">Approve</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Disapprove -->
        <div class="modal fade" id="disapproveModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="disapproveModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="disapproveModalLabel{{ $order->id }}">Disapprove Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to disapprove this payment?</p>
                        <p>Order will be deleted <b>permanently</b>, please be sure to contact the Customer beforehand.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('payment.disapprove', ['order' => $order->id]) }}"
                            class="btn btn-outline-danger">Disapprove</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Image Preview -->
        <div class="modal fade" id="imageModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="imageModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel{{ $order->id }}">Transder Evidence Image Preview
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/' . $order->transfer_evidence_img) }}" class="img-fluid"
                            alt="Full-Screen Image">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
