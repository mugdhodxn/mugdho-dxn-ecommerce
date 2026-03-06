@extends('layouts.app')

@section('title', 'Order Details - Mugdho DXN')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Order Details</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Back to Orders
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Order #{{ $order->order_number }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Order Date:</strong></p>
                            <p>{{ $order->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Payment Method:</strong></p>
                            <p class="text-uppercase">{{ $order->payment_method }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Payment Status:</strong></p>
                            <p>
                                @if($order->payment_status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @elseif($order->payment_status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-danger">{{ ucfirst($order->payment_status) }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Order Status:</strong></p>
                            <p>
                                @if($order->status == 'delivered')
                                    <span class="badge bg-success">Delivered</span>
                                @elseif($order->status == 'shipped')
                                    <span class="badge bg-info">Shipped</span>
                                @elseif($order->status == 'processing')
                                    <span class="badge bg-primary">Processing</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @else
                                    <span class="badge bg-secondary">Pending</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($order->transaction_id)
                    <div class="mb-3">
                        <p class="mb-1"><strong>Transaction ID:</strong></p>
                        <p>{{ $order->transaction_id }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Order Items</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('products.show', $item->product->slug) }}">
                                        {{ $item->product_name }}
                                    </a>
                                </td>
                                <td>৳{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>৳{{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Shipping Information</h5>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>{{ $order->customer_name }}</strong></p>
                    <p class="mb-1">{{ $order->customer_phone }}</p>
                    <p class="mb-1">{{ $order->customer_email }}</p>
                    <hr>
                    <p class="mb-1">{{ $order->shipping_address }}</p>
                    <p class="mb-1">{{ $order->city }}@if($order->postal_code), {{ $order->postal_code }}@endif</p>
                    
                    @if($order->notes)
                    <hr>
                    <p class="mb-1"><strong>Notes:</strong></p>
                    <p class="mb-0">{{ $order->notes }}</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>৳{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span>
                            @if($order->shipping_cost == 0)
                                <span class="text-success">FREE</span>
                            @else
                                ৳{{ number_format($order->shipping_cost, 2) }}
                            @endif
                        </span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total:</span>
                        <span class="fw-bold fs-4 text-success">৳{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
