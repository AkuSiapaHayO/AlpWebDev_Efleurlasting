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
                            <th>Payment Status</th>
                            <th>Payment Details</th>
                            <th>Transfer Evidence Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order['order_date'] }}</td>
                                <td>Rp {{ number_format($order['total_amount'], 0, ',', '.') }}</td>
                                <td>{{ $order['payment_status'] }}</td>
                                <td>{{ $order['payment_details'] }}</td>
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
                                    <a href="#" class="btn btn-outline-primary d-block mb-2">View More</a>
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
@endsection
