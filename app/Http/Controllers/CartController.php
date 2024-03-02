<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_to_cart(Product $product, Request $request)
    {
        $request->validate([
            'amount' => 'required|gte:1|lte:' . $product->stock
        ]);

        $user_id = Auth::id();
        $product_id = $product->id;

        Cart::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'amount' => $request->amount
        ]);

        return Redirect::route('cart');
    }

    public function show_cart()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();
        $user = Auth::user();
        $is_admin = $user->is_admin;
        if ($is_admin) {
            $orders = Order::all();
        } else {
            $orders = Order::where('user_id', $user->id)->get();
        }
        return view('product.cart', compact('carts', 'orders'));
    }

    public function update_cart(Cart $cart, Request $request)
    {
        $request->validate([
            'amount' => 'required|gte:1|lte:' . $cart->product->stock
        ]);

        $cart->update([
            'amount' => $request->amount
        ]);

        return Redirect::route('cart');
    }

    public function delete_cart(Cart $cart)
    {
        $cart->delete();
        return Redirect::back();
    }

    public function getCartAmount($cartId)
    {
        $cart = Cart::find($cartId);

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        return response()->json(['amount' => $cart->amount]);
    }
}
