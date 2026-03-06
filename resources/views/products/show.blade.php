@extends('layouts.app')

@section('title', $product->name . ' - Mugdho DXN')

@section('content')
<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-5">
            <div class="position-relative">
                <img src="{{ asset('storage/' . $product->image) }}" 
                     class="img-fluid rounded shadow" 
                     alt="{{ $product->name }}"
                     onerror="this.src='https://via.placeholder.com/500x500?text={{ urlencode($product->name) }}'">
                @if($product->discount_percentage > 0)
                    <span class="badge-discount">-{{ $product->discount_percentage }}%</span>
                @endif
            </div>
        </div>
        
        <div class="col-md-7">
            <span class="badge bg-secondary mb-2">{{ $product->category->name }}</span>
            <h1 class="mb-3">{{ $product->name }}</h1>
            
            <div class="mb-3">
                @if($product->discount_price)
                    <span class="price-original fs-5">৳{{ number_format($product->price, 2) }}</span>
                @endif
                <div class="price-final">৳{{ number_format($product->final_price, 2) }}</div>
            </div>

            <div class="mb-3">
                <p class="{{ $product->stock > 10 ? 'text-success' : 'text-warning' }} fw-bold">
                    <i class="fas fa-box"></i> 
                    @if($product->stock > 10)
                        In Stock ({{ $product->stock }} available)
                    @elseif($product->stock > 0)
                        Limited Stock ({{ $product->stock }} left)
                    @else
                        Out of Stock
                    @endif
                </p>
                <p class="text-muted"><i class="fas fa-barcode"></i> SKU: {{ $product->sku }}</p>
            </div>

            <div class="mb-4">
                <h5>Description</h5>
                <p>{{ $product->description }}</p>
            </div>

            @if($product->benefits)
            <div class="mb-4">
                <h5>Benefits</h5>
                <p>{{ $product->benefits }}</p>
            </div>
            @endif

            @if($product->ingredients)
            <div class="mb-4">
                <h5>Ingredients</h5>
                <p>{{ $product->ingredients }}</p>
            </div>
            @endif

            @if($product->usage)
            <div class="mb-4">
                <h5>How to Use</h5>
                <p>{{ $product->usage }}</p>
            </div>
            @endif

            @if($product->stock > 0)
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-3">
                @csrf
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-accent btn-lg">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </div>
            </form>
            @else
            <button class="btn btn-secondary btn-lg w-100" disabled>Out of Stock</button>
            @endif

            <div class="alert alert-info">
                <i class="fas fa-truck"></i> 
                <strong>Free Shipping</strong> on orders over ৳3,000
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="mt-5">
        <h3 class="mb-4">Related Products</h3>
        <div class="row g-4">
            @foreach($relatedProducts as $related)
            <div class="col-md-3">
                <div class="card h-100 product-card">
                    <img src="{{ asset('storage/' . $related->image) }}" 
                         class="card-img-top product-image" 
                         alt="{{ $related->name }}"
                         onerror="this.src='https://via.placeholder.com/300x250?text={{ urlencode($related->name) }}'">
                    <div class="card-body">
                        <h6 class="card-title">{{ $related->name }}</h6>
                        <div class="price-final fs-5">৳{{ number_format($related->final_price, 2) }}</div>
                        <a href="{{ route('products.show', $related->slug) }}" class="btn btn-sm btn-outline-primary mt-2 w-100">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
