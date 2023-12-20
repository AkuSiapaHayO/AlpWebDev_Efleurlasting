@extends('layouts.app')

@section('content')
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
                                        <img src="{{ asset('storage/' . $order->transfer_evidence_img) }}"
                                            alt="Transfer Evidence" class="card-img-top img-fluid"
                                            style="width: 30vh; object-fit: cover;">
                                    @else
                                        <p class="text-muted">No image available</p>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary d-block mb-2"
                                        data-bs-toggle="modal" data-bs-target="#viewModal{{ $order->id }}">
                                        View Details
                                    </button>
                                    <a href="#" class="btn btn-success d-block mb-2">Approve</a>
                                    <a href="#" class="btn btn-danger d-block">Disapprove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @foreach ($orders as $order)
        {{-- View Modal --}}
        <div class="modal fade" id="viewModal{{ $order->id }}" tabindex="-1" role="dialog"
            aria-labelledby="viewModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel{{ $order->id }}"> View Order Details </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <dl class="row">
                                    <dt class="col-sm-4">Order Date</dt>
                                    <dd class="col-sm-8">: {{ $order->order_date }}</dd>

                                    <dt class="col-sm-4">Total Amount</dt>
                                    <dd class="col-sm-8">: {{ $order->total_amount }}</dd>

                                    <dt class="col-sm-4">Payment Status</dt>
                                    <dd class="col-sm-8">: {{ $order->payment_status ? 'Approved' : 'Unapproved' }}</dd>

                                    <dt class="col-sm-4">Delivery Date</dt>
                                    <dd class="col-sm-8">: {{ $order->delivery_date }}</dd>

                                    <dt class="col-sm-4">Delivery Time</dt>
                                    <dd class="col-sm-8">: {{ $order->delivery_time }}</dd>

                                    <dt class="col-sm-4">Recipient Name</dt>
                                    <dd class="col-sm-8">: {{ $order->recipient_name }}</dd>

                                    <dt class="col-sm-4">Recipient Phone</dt>
                                    <dd class="col-sm-8">: {{ $order->recipient_phone }}</dd>

                                    <dt class="col-sm-4">Recipient Address</dt>
                                    <dd class="col-sm-8">: {{ $order->recipient_address }}</dd>

                                    <dt class="col-sm-4">Notes</dt>
                                    <dd class="col-sm-8">: {{ $order->notes }}</dd>

                                    <dt class="col-sm-4">Payment Details</dt>
                                    <dd class="col-sm-8">: {{ $order->payment_details ? 'Approved' : 'Unapproved' }}</dd>

                                    <dt class="col-sm-4">Delivery Status</dt>
                                    <dd class="col-sm-8">: {{ $order->delivery_status ? 'Delivered' : 'Not Delivered' }}
                                    </dd>

                                    <dt class="col-sm-4">Is Delivery</dt>
                                    <dd class="col-sm-8">: {{ $order->isDelivery ? 'Pick Up' : 'Delivery' }}</dd>

                                    <dt class="col-sm-4">User ID</dt>
                                    <dd class="col-sm-8">: {{ $order->user_id }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <h6>Order Items</h6>
                                <ul>
                                    @foreach ($order->orderItems as $orderItem)
                                        @php
                                            $productColor = $orderItem->productcolor;
                                            $product = $productColor->product;
                                            $subtotal = $orderItem->quantity * $product->price;
                                        @endphp
                                        <tr>
                                            <td>{{ $product->category->category_name }} - {{ $product->product_name }}
                                            </td>
                                            <td>{{ $productColor->color->color_name }}</td>
                                            <td>{{ $orderItem->quantity }}</td>
                                            <td>{{ $orderItem->note }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $subtotal }}</td>
                                        </tr>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
