@extends('layouts.app')

@section('title', 'Products - Mugdho DXN')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Our Products</h1>
    
    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form action="{{ route('products.index') }}" method="GET" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <form action="{{ route('products.index') }}" method="GET">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="">Sort By</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A to Z</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row g-4">
        @forelse($products as $product)
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
                    <span class="badge bg-secondary mb-2">{{ $product->category->name }}</span>
                    <h6 class="card-title">{{ $product->name }}</h6>
                    <p class="card-text small text-muted">{{ Str::limit($product->description, 60) }}</p>
                    <div class="mb-2">
                        @if($product->discount_price)
                            <span class="price-original">৳{{ number_format($product->price, 2) }}</span>
                        @endif
                        <div class="price-final">৳{{ number_format($product->final_price, 2) }}</div>
                    </div>
                    <p class="small {{ $product->stock > 10 ? 'text-success' : 'text-warning' }}">
                        <i class="fas fa-box"></i> {{ $product->stock }} in stock
                    </p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-accent w-100">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-secondary w-100" disabled>Out of Stock</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No products found.
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-5">
        {{ $products->links() }}
    </div>
</div>
@endsection
