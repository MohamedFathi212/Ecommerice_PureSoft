<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = auth()->user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty!');
        }
        return view('checkout.index', compact('cart'));
    }
    public function placeOrder(Request $request)
    {
        $cart = auth()->user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty!');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $cart->total(),
            'status' => 'pending',
        ]);
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }
        $cart->update(['status' => 'checked_out']);
        $cart->items()->delete();
        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }
}
