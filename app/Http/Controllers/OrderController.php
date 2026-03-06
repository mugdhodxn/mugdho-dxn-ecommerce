<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('user_id', auth()->id())
            ->with('items.product')
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function success($id)
    {
        $order = Order::where('user_id', auth()->id())
            ->with('items.product')
            ->findOrFail($id);

        return view('orders.success', compact('order'));
    }
}
