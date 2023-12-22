@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.setting') }}">
                    <button class="btn btn-outline-primary">Back</button>
                </a>
                <h1>View Order</h1>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order_ID</th>
                            <th>Order Date</th>
                            <th>Customer</th>
                            <th>iS Delivery</th>
                            <th>Delivery Status</th>
                            <th>Delivery Date</th>
                            <th>Total Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_date }}</td>
                                @php
                                    $user = \App\Models\User::find($order->user_id);
                                @endphp
                                <td>{{ $user->name }}</td>
                                <td>{{ $order->isDelivery ? 'Pick Up' : 'Delivery' }}</td>
                                <td>
                                    @if($order->delivery_status)
                                        <span class="btn btn-success">Delivered</span>
                                    @else
                                        <span class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal">Not Delivered</span>
                                    @endif
                                </td>

                                <td>{{ $order->order_date }}</td>
                                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td>
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
    @foreach ($orders as $order)
        {{-- Confirmation Modal --}}
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
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

        {{-- View Details Modal --}}
        <div id="orderDetailsModal{{ $order->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="orderDetailsModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <h3>Order Details</h3>
                                        <tbody>
                                            <tr>
                                                <th>Order Date</th>
                                                <td>{{ $order->order_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Amount</th>
                                                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}
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
                                <div class="col-md-6">
                                    <h3>Order Items</h3>
                                    <table class="table">
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
                                                        @if ($product->images->isNotEmpty() && Storage::disk('public')->exists($product->images->first()->image_name))
                                                            <img src="{{ asset('storage/' . $product->images->first()->image_name) }}"
                                                                class="d-block w-100" alt="..."
                                                                style="height: 10vh; max-width: 20vh; object-fit: cover;">
                                                        @else
                                                            @if ($product->images->isNotEmpty())
                                                                <img src="{{ asset('Assets/products/' . $product->images->first()->image_name) }}"
                                                                    alt="Product Image" class="card-img-top img-fluid"
                                                                    style="height: 10vh; max-width: 20vh; object-fit: cover;">
                                                            @else
                                                                <div class="card-img-top d-flex align-items-center justify-content-center"
                                                                    style="height: 10vh; background: rgba(255, 255, 255, 0.7);">
                                                                    <p class="text-muted">No image available</p>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td style="max-width: 100px">
                                                        {{ $productColor->color->color_name }}
                                                    </td>
                                                    <td>{{ $orderItem->quantity }}</td>
                                                    <td>{{ $orderItem->note }}</td>
                                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}
                                                    </td>
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
        </div>
    @endforeach
@endsection
