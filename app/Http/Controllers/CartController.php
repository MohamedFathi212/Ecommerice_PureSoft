<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
            'status' => 'active'
        ]);
        $cartItems = CartItem::where('cart_id', $cart->id)->with('product')->get();
        return view('cart.index', compact('cartItems', 'cart'));
    }
    public function add(Request $request, $productId)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
            'status' => 'active'
        ]);
        $product = Product::findOrFail($productId);

        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->first();
        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $request->input('quantity', 1),
            ]);
        }
        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }
    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cart = Cart::where('id', $cartItem->cart_id)->where('user_id', auth()->id())->firstOrFail();
        $cartItem->update([
            'quantity' => $request->input('quantity', 1),
        ]);
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cart = Cart::where('id', $cartItem->cart_id)->where('user_id', auth()->id())->firstOrFail();
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }
    public function clear()
    {
        $cart = auth()->user()->cart()->first();
        if ($cart) {
            $cart->items()->delete();
            return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
        }
    }
}
