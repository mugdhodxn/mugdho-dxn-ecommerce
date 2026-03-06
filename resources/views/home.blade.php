@extends('layouts.app')

@section('title', 'Mugdho DXN - Premium DXN Products in Bangladesh')

@section('content')
<!-- Hero Section -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold mb-4">Welcome to Mugdho DXN</h1>
                <p class="lead mb-4">Discover premium DXN health and wellness products. Authentic Ganoderma, Spirulina, and more delivered to your doorstep in Bangladesh.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Shop Now</a>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/hero-image.jpg') }}" alt="DXN Products" class="img-fluid rounded" onerror="this.src='https://via.placeholder.com/600x400?text=DXN+Products'">
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="container my-5">
    <h2 class="text-center mb-5">Shop by Category</h2>
    <div class="row g-4">
        @foreach($categories as $category)
        <div class="col-md-4">
            <div class="card h-100 text-center product-card">
                <div class="card-body">
                    <i class="fas fa-leaf fa-3x text-success mb-3"></i>
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <p class="card-text">{{ $category->description }}</p>
                    <p class="text-muted">{{ $category->products_count }} Products</p>
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="btn btn-outline-primary">View Products</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Featured Products -->
<div class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Featured Products</h2>
        <div class="row g-4">
            @foreach($featuredProducts as $product)
            <div class="col-md-3">
                <div class="card h-100 product-card">
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             class="card-img-top product-image" 
                             alt="{{ $product->name }}"
                             onerror="this.src='https://via.placeholder.com/300x250?text={{ urlencode($product->name) }}'">
                        @if($product->discount_percentage > 0)
                            <span class="badge-discount">-{{ $product->discount_percentage }}%</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <div class="mb-2">
                            @if($product->discount_price)
                                <span class="price-original">৳{{ number_format($product->price, 2) }}</span>
                            @endif
                            <div class="price-final">৳{{ number_format($product->final_price, 2) }}</div>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-accent w-100">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">View All Products</a>
        </div>
    </div>
</div>

<!-- Why Choose Us -->
<div class="container my-5">
    <h2 class="text-center mb-5">Why Choose Mugdho DXN?</h2>
    <div class="row g-4">
        <div class="col-md-3 text-center">
            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
            <h5>Authentic Products</h5>
            <p>100% genuine DXN products directly sourced</p>
        </div>
        <div class="col-md-3 text-center">
            <i class="fas fa-shipping-fast fa-3x text-success mb-3"></i>
            <h5>Fast Delivery</h5>
            <p>Quick delivery across Bangladesh</p>
        </div>
        <div class="col-md-3 text-center">
            <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>
            <h5>Secure Payment</h5>
            <p>Multiple secure payment options</p>
        </div>
        <div class="col-md-3 text-center">
            <i class="fas fa-headset fa-3x text-success mb-3"></i>
            <h5>24/7 Support</h5>
            <p>Always here to help you</p>
        </div>
    </div>
</div>
@endsection
