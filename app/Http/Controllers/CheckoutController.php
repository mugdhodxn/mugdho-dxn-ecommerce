<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingCost = $this->calculateShipping($subtotal);
        $total = $subtotal + $shippingCost;

        return view('checkout.index', compact('cart', 'subtotal', 'shippingCost', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'payment_method' => 'required|in:bkash,nagad,card,cod',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        DB::beginTransaction();

        try {
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            $shippingCost = $this->calculateShipping($subtotal);
            $total = $subtotal + $shippingCost;

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => Order::generateOrderNumber(),
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'cod' ? 'pending' : 'pending',
                'status' => 'pending',
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $request->shipping_address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'notes' => $request->notes,
            ]);

            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);
                
                if ($product && $product->stock >= $item['quantity']) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $productId,
                        'product_name' => $item['name'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'total' => $item['price'] * $item['quantity'],
                    ]);

                    $product->decrement('stock', $item['quantity']);
                } else {
                    throw new \Exception('Product out of stock: ' . $item['name']);
                }
            }

            DB::commit();

            session()->forget('cart');

            if ($request->payment_method === 'cod') {
                return redirect()->route('order.success', $order->id);
            } else {
                return redirect()->route('payment.process', ['order' => $order->id, 'method' => $request->payment_method]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Order creation failed: ' . $e->getMessage());
        }
    }

    private function calculateShipping($subtotal)
    {
        if ($subtotal >= 3000) {
            return 0; // Free shipping
        } elseif ($subtotal >= 1500) {
            return 60;
        } else {
            return 100;
        }
    }
}
