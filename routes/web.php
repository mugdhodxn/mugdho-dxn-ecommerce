<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCategoryController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Authentication Routes
Auth::routes();

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Payment
    Route::get('/payment/process/{order}', [PaymentController::class, 'process'])->name('payment.process');
    Route::post('/payment/bkash/callback', [PaymentController::class, 'bkashCallback'])->name('payment.bkash.callback');
    Route::post('/payment/nagad/callback', [PaymentController::class, 'nagadCallback'])->name('payment.nagad.callback');
    Route::post('/payment/sslcommerz/success', [PaymentController::class, 'sslcommerzSuccess'])->name('payment.sslcommerz.success');
    Route::post('/payment/sslcommerz/fail', [PaymentController::class, 'sslcommerzFail'])->name('payment.sslcommerz.fail');
    Route::post('/payment/sslcommerz/cancel', [PaymentController::class, 'sslcommerzCancel'])->name('payment.sslcommerz.cancel');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/{id}/success', [OrderController::class, 'success'])->name('order.success');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Products
    Route::resource('products', AdminProductController::class);
    
    // Categories
    Route::resource('categories', AdminCategoryController::class);
    
    // Orders
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});
