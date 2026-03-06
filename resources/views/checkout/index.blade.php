@extends('layouts.app')

@section('title', 'Checkout - Mugdho DXN')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Checkout</h1>

    <div class="row">
        <div class="col-md-7">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Shipping Information</h5>
                    
                    <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" 
                                       value="{{ old('customer_name', auth()->user()->name) }}" required>
                                @error('customer_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Email *</label>
                                <input type="email" name="customer_email" class="form-control @error('customer_email') is-invalid @enderror" 
                                       value="{{ old('customer_email', auth()->user()->email) }}" required>
                                @error('customer_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number *</label>
                                <input type="text" name="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" 
                                       value="{{ old('customer_phone', auth()->user()->phone) }}" required>
                                @error('customer_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Shipping Address *</label>
                            <textarea name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" 
                                      rows="3" required>{{ old('shipping_address', auth()->user()->address) }}</textarea>
                            @error('shipping_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">City *</label>
                                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" 
                                       value="{{ old('city', auth()->user()->city) }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" 
                                       value="{{ old('postal_code', auth()->user()->postal_code) }}">
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Order Notes (Optional)</label>
                            <textarea name="notes" class="form-control" rows="2" 
                                      placeholder="Special instructions for delivery">{{ old('notes') }}</textarea>
                        </div>

                        <h5 class="mt-4 mb-3">Payment Method *</h5>
                        
                        <div class="mb-3">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="bkash" value="bkash" required>
                                <label class="form-check-label" for="bkash">
                                    <img src="https://seeklogo.com/images/B/bkash-logo-835789094F-seeklogo.com.png" alt="bKash" style="height: 30px;"> bKash
                                </label>
                            </div>
                            
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="nagad" value="nagad">
                                <label class="form-check-label" for="nagad">
                                    <img src="https://seeklogo.com/images/N/nagad-logo-7A70CCFEE0-seeklogo.com.png" alt="Nagad" style="height: 30px;"> Nagad
                                </label>
                            </div>
                            
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                                <label class="form-check-label" for="card">
                                    <i class="fas fa-credit-card"></i> Credit/Debit Card (SSLCOMMERZ)
                                </label>
                            </div>
                            
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod">
                                <label class="form-check-label" for="cod">
                                    <i class="fas fa-money-bill-wave"></i> Cash on Delivery
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-accent btn-lg w-100 mt-3">
                            Place Order <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Order Summary</h5>
                    
                    @foreach($cart as $id => $item)
                    <div class="d-flex mb-3">
                        <img src="{{ asset('storage/' . $item['image']) }}" 
                             alt="{{ $item['name'] }}" 
                             style="width: 60px; height: 60px; object-fit: cover;"
                             class="me-3 rounded"
                             onerror="this.src='https://via.placeholder.com/60x60'">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $item['name'] }}</h6>
                            <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                        </div>
                        <div class="text-end">
                            <strong>৳{{ number_format($item['price'] * $item['quantity'], 2) }}</strong>
                        </div>
                    </div>
                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>৳{{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span>
                            @if($shippingCost == 0)
                                <span class="text-success">FREE</span>
                            @else
                                ৳{{ number_format($shippingCost, 2) }}
                            @endif
                        </span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold fs-5">Total:</span>
                        <span class="fw-bold fs-4 text-success">৳{{ number_format($total, 2) }}</span>
                    </div>

                    <div class="alert alert-info small">
                        <i class="fas fa-info-circle"></i> 
                        @if($subtotal >= 3000)
                            You're getting FREE shipping!
                        @elseif($subtotal >= 1500)
                            Add ৳{{ number_format(3000 - $subtotal, 2) }} more for FREE shipping
                        @else
                            Add ৳{{ number_format(3000 - $subtotal, 2) }} more for FREE shipping
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
