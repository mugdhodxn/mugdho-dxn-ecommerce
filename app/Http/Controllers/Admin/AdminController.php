<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalProducts = Product::count();
        $lowStockProducts = Product::where('stock', '<', 10)->count();
        
        $recentOrders = Order::with('user')->latest()->take(10)->get();
        
        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'totalProducts',
            'lowStockProducts',
            'recentOrders'
        ));
    }
}
