@extends('layouts.app')

@section('title', 'My Orders - Mugdho DXN')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">My Orders</h1>

    @if($orders->count() > 0)
        <div class="row">
            @foreach($orders as $order)
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h6 class="mb-1">Order #{{ $order->order_number }}</h6>
                                <small class="text-muted">{{ $order->created_at->format('d M Y, h:i A') }}</small>
                            </div>
                            <div class="col-md-2">
                                <small class="text-muted">Total</small>
                                <h5 class="mb-0">৳{{ number_format($order->total, 2) }}</h5>
                            </div>
                            <div class="col-md-2">
                                <small class="text-muted">Payment</small>
                                <div>
                                    @if($order->payment_status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($order->payment_status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">{{ ucfirst($order->payment_status) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <small class="text-muted">Status</small>
                                <div>
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
                                </div>
                            </div>
                            <div class="col-md-3 text-end">
                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                    View Details <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @else
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-shopping-bag fa-3x mb-3"></i>
            <h4>No orders yet</h4>
            <p>Start shopping and place your first order</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Shop Now</a>
        </div>
    @endif
</div>
@endsection
