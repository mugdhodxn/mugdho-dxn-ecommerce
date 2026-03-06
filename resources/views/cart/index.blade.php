@extends('layouts.app')

@section('title', 'Shopping Cart - Mugdho DXN')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Shopping Cart</h1>

    @if(empty($cart) || count($cart) == 0)
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-shopping-cart fa-3x mb-3"></i>
            <h4>Your cart is empty</h4>
            <p>Start shopping and add products to your cart</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $item['image']) }}" 
                                                 alt="{{ $item['name'] }}" 
                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                 class="me-3 rounded"
                                                 onerror="this.src='https://via.placeholder.com/60x60'">
                                            <div>
                                                <a href="{{ route('products.show', $item['slug']) }}" class="text-decoration-none">
                                                    {{ $item['name'] }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>৳{{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <div class="input-group" style="width: 120px;">
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                                       min="1" class="form-control form-control-sm" 
                                                       onchange="this.form.submit()">
                                            </div>
                                        </form>
                                    </td>
                                    <td class="fw-bold">৳{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left"></i> Continue Shopping
                            </a>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-trash"></i> Clear Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span class="fw-bold">৳{{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span class="text-muted">Calculated at checkout</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Total:</span>
                            <span class="fw-bold fs-4 text-success">৳{{ number_format($total, 2) }}</span>
                        </div>

                        @auth
                            <a href="{{ route('checkout.index') }}" class="btn btn-accent w-100 btn-lg">
                                Proceed to Checkout <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-accent w-100 btn-lg">
                                Login to Checkout <i class="fas fa-arrow-right"></i>
                            </a>
                            <p class="text-center mt-2 small">
                                Don't have an account? <a href="{{ route('register') }}">Register</a>
                            </p>
                        @endauth

                        <div class="alert alert-info mt-3 small">
                            <i class="fas fa-info-circle"></i> Free shipping on orders over ৳3,000
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
