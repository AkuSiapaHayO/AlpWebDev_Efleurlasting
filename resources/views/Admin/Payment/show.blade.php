@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="card shadow-lg my-3 my-md-4" style="border: none;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <a href="{{ route('payment.view') }}">
                        <button class="btn btn-info fw-bold text-white">Back</button>
                    </a>
                    <h1 class="heading mx-auto mb-0">View Order</h1>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="card shadow-lg mb-3" style="border: none;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            @if (File::exists(public_path($order->transfer_evidence_img)))
                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $order->id }}"
                                    class="w-100 h-100">
                                    <img src="{{ asset($order->transfer_evidence_img) }}" alt="Transfer Evidence"
                                        class="img-fluid w-100 h-100 rounded" style="object-fit: cover; cursor: pointer;">
                                </a>
                            @else
                                <p class="text-muted">No image available</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Order Date</th>
                                            <td>{{ $order->order_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Amount</th>
                                            <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Status</th>
                                            <td>{{ $order->payment_status ? 'Approved' : 'Unapproved' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Details</th>
                                            <td>{{ $order->payment_details }}</td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <th>User ID</th>
                                            <td>{{ $order->user_id }}</td>
                                            @php
                                                $user = \App\Models\User::find($order->user_id);
                                            @endphp
                                        </tr>
                                        <tr>
                                            <th>User Details</th>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>User Phone</th>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="#" class="btn btn-outline-success d-block mb-2" data-bs-toggle="modal"
                                data-bs-target="#approveModal{{ $order->id }}"
                                data-order-id="{{ $order->id }}">Approve</a>
                            <a href="#" class="btn btn-outline-danger d-block" data-bs-toggle="modal"
                                data-bs-target="#disapproveModal{{ $order->id }}"
                                data-order-id="{{ $order->id }}">Disapprove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="card mb-3 shadow-lg" style="border: none;">
                        <div class="card-body">
                            <h1 class="heading fs-2 mb-0 borders-left">Order Information</h1>
                        </div>
                    </div>
                    <div class="card mb-3 shadow-lg" style="border: none;">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <th>Order Date</th>
                                            <td>{{ $order->order_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Amount</th>
                                            <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Status</th>
                                            <td>{{ $order->payment_status ? 'Approved' : 'Unapproved' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Delivery Date</th>
                                            <td>{{ $order->delivery_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Delivery Time</th>
                                            <td>{{ $order->delivery_time }}</td>
                                        </tr>
                                        <tr>
                                            <th>Recipient Name</th>
                                            <td>{{ $order->recipient_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Recipient Phone</th>
                                            <td>{{ $order->recipient_phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Recipient Address</th>
                                            <td>{{ $order->recipient_address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Notes</th>
                                            <td>{{ $order->notes }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Details</th>
                                            <td>{{ $order->payment_details }}</td>
                                        </tr>
                                        <tr>
                                            <th>Delivery Status</th>
                                            <td>{{ $order->delivery_status ? 'Delivered' : 'Not Delivered' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Is Delivery</th>
                                            <td>{{ $order->isDelivery ? 'Pick Up' : 'Delivery' }}</td>
                                        </tr>
                                        <tr>
                                            <th>User ID</th>
                                            <td>{{ $order->user_id }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3 shadow-lg" style="border: none;">
                        <div class="card-body">
                            <h1 class="heading fs-2 mb-0 borders-left">Order Items</h1>
                        </div>
                    </div>
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
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $orderItem)
                                            @php
                                                $productColor = $orderItem->productcolor;
                                                $product = $productColor->product;
                                                $subtotal = $orderItem->quantity * $product->price;
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $product->category->category_name }}
                                                    <br> - {{ $product->product_name }}
                                                    <br>
                                                    @if (File::exists(public_path($product->images->first()->image_name)))
                                                        <img src="{{ asset($product->images->first()->image_name) }}"
                                                            class="d-block w-100" alt="..."
                                                            style="height: 10vh; max-width: 20vh; object-fit: cover;">
                                                    @else
                                                        <img src="{{ asset('Assets/Products/' . $product->images->first()->image_name) }}"
                                                            class="d-block w-100" alt="..."
                                                            style="height: 10vh; max-width: 20vh; object-fit: cover;">
                                                    @endif
                                                </td>
                                                <td style="max-width: 100px">{{ $productColor->color->color_name }}</td>
                                                <td>{{ $orderItem->quantity }}</td>
                                                <td>{{ $orderItem->note }}</td>
                                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4"></td>
                                            <td>Delivery Fee</td>
                                            <td>{{ $order->isDelivery ? 'Rp 0.000' : 'Rp 25.000' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td>Total</td>
                                            <td>Rp
                                                {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
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
                    @livewire('approve-payment', ['orderId' => $order->id], key($order->id))
                </div>
            </div>
        </div>
    </section>

    <section>
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
                    @livewire('disapprove-payment', ['orderId' => $order->id], key($order->id))
                </div>
            </div>
        </div>
    </section>

    <section>
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
    </section>
@endsection
