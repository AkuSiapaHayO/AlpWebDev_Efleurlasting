@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="card shadow-lg my-3 my-md-4" style="border: none;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.setting') }}">
                        <button class="btn btn-pink-color fw-bold text-white">Back</button>
                    </a>
                    <h1 class="heading mx-auto mb-0">View Order</h1>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr style="white-space: nowrap">
                                    <th>Order_ID</th>
                                    <th>Order Date</th>
                                    <th>Customer</th>
                                    <th>iS Delivery</th>
                                    <th>Delivery Status</th>
                                    <th>Delivery Date</th>
                                    <th>Total Amount</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="align-middle">{{ $order->id }}</td>
                                        <td class="align-middle">{{ $order->order_date }}</td>
                                        @php
                                            $user = \App\Models\User::find($order->user_id);
                                        @endphp
                                        <td class="align-middle">{{ $user->name }}</td>
                                        <td class="align-middle">{{ $order->isDelivery ? 'Pick Up' : 'Delivery' }}</td>
                                        <td class="align-middle" style="white-space: nowrap;">
                                            @if ($order->delivery_status)
                                                <span class="btn btn-success">Delivered</span>
                                            @else
                                                <span class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirmationModal{{ $order->id }}">Not Delivered</span>
                                            @endif
                                        </td class="align-middle">

                                        <td class="align-middle">{{ $order->order_date }}</td>
                                        <td class="align-middle">Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </td>
                                        <td class="align-middle text-center" style="white-space: nowrap;">
                                            <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#orderDetailsModal{{ $order->id }}">
                                                View More
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        @foreach ($orders as $order)
            <div class="modal fade" id="confirmationModal{{ $order->id }}" tabindex="-1" aria-labelledby="confirmationModalLabel{{ $order->id }}"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to mark this order as delivered?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href="{{ route('order.finish', ['order' => $order->id]) }}" class="btn btn-success">Mark as
                                Delivered</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="orderDetailsModal{{ $order->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="orderDetailsModalLabel{{ $order->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-2 heading mb-0 borders-left" id="orderDetailsModalLabel">Order Details
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <div class="card shadow-lg mb-3" style="border: none;">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th>Order Date</th>
                                                        <td>{{ $order->order_date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Amount</th>
                                                        <td>Rp
                                                            {{ number_format($order->total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Payment Status</th>
                                                        <td>
                                                            @if ($order->payment_status)
                                                                <span class="btn btn-success">Approved</span>
                                                            @else
                                                                <span class="btn btn-secondary">Unapproved</span>
                                                            @endif
                                                        </td>
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
                                                        <td>
                                                            @if ($order->delivery_status)
                                                                <span class="btn btn-success">Delivered</span>
                                                            @else
                                                                <span class="btn btn-danger">Not Delivered</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Is Delivery</th>
                                                        <td>{{ $order->isDelivery ? 'Pick Up' : 'Delivery' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
                                                        <tr style="white-space: nowrap;">
                                                            <td>
                                                                {{ $product->category->category_name }}
                                                                <br> - {{ $product->product_name }}
                                                                <br>

                                                            </td>
                                                            <td>
                                                                {{ $productColor->color->color_name }}
                                                            </td>
                                                            <td>{{ $orderItem->quantity }}</td>
                                                            <td>{{ $orderItem->note }}</td>
                                                            <td>Rp
                                                                {{ number_format($product->price, 0, ',', '.') }}
                                                            </td>
                                                            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr style="white-space: nowrap;">
                                                        <td colspan="4"></td>
                                                        <td>Delivery Fee</td>
                                                        <td>{{ $order->isDelivery ? 'Rp 0.000' : 'Rp 25.000' }}
                                                        </td>
                                                    </tr>
                                                    <tr style="white-space: nowrap;">
                                                        <td colspan="4"></td>
                                                        <td>Total</td>
                                                        <td>Rp
                                                            {{ number_format($order->total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection
