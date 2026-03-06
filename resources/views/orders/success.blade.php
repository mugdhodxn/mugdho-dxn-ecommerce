@extends('layouts.app')

@section('title', 'Order Success - Mugdho DXN')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-body py-5">
                    <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                    <h1 class="mt-4 mb-3">Order Placed Successfully!</h1>
                    <p class="lead">Thank you for your order. Your order number is:</p>
                    <h3 class="text-primary mb-4">{{ $order->order_number }}</h3>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        We've sent a confirmation email to <strong>{{ $order->customer_email }}</strong>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6>Order Total</h6>
                                    <h4 class="text-success">৳{{ number_format($order->total, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6>Payment Status</h6>
                                    <h4>
                                        @if($order->payment_status == 'paid')
                                            <span class="badge bg-success">Paid</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-lg me-2">
                            <i class="fas fa-eye"></i> View Order Details
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-shopping-bag"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
