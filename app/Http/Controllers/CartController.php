<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->stock < 1) {
            return back()->with('error', 'Product is out of stock');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] >= $product->stock) {
                return back()->with('error', 'Cannot add more items than available stock');
            }
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->final_price,
                'quantity' => 1,
                'image' => $product->image,
                'slug' => $product->slug,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Product added to cart successfully');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $product = Product::findOrFail($id);

        if (isset($cart[$id])) {
            $quantity = $request->quantity;
            
            if ($quantity > $product->stock) {
                return back()->with('error', 'Requested quantity exceeds available stock');
            }

            if ($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
            } else {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
            return back()->with('success', 'Cart updated successfully');
        }

        return back()->with('error', 'Product not found in cart');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return back()->with('success', 'Product removed from cart');
        }

        return back()->with('error', 'Product not found in cart');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared successfully');
    }
}
