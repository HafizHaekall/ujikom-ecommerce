<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    // fungsi untuk menampilkan data atau riwayat order
    public function index_order()
    {
        $user = Auth::user();
        $is_admin = $user->is_admin;
    
        // pengecekan role untuk hak akses
        if ($is_admin) {
            $orders = Order::all();
        } else {
            $orders = Order::where('user_id', $user->id)->get();
        }
    
        return view('order.index', [
            'active' => 'order',
        ], compact('orders'));
    }
    
    // fungsi untuk menampilkan detail order tertentu
    public function show_order(Order $order)
    {
        $user = Auth::user();
        $is_admin = $user->is_admin;
    
        if ($is_admin || $order->user_id == $user->id) {
            return view('order.show', [
                'active' => 'order',
            ], compact('order'));
        }

        $order = Order::findOrFail($order->id);
        return view('order.show', compact('order'));
    }

    // fungsi untuk melakukan checkout produk
    public function checkout()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        // cek jika order kosong
        if ($carts->isEmpty()) {
            return Redirect::back()->with('error', 'Tidak ada item di keranjang.');
        }

        $order = Order::create([
            'user_id' => $user_id
        ]);

        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);

            $product->update([
                'stock' => $product->stock - $cart->amount
            ]);

            Transaction::create([
                'amount' => $cart->amount,
                'order_id' => $order->id,
                'product_id' => $cart->product_id
            ]);
            $cart->delete();
        }
        return Redirect::route('index_order')->with(['success' =>'Checkout berhasil!']);
    }

    // fungsi untuk mengunggah bukti pembayaran atau submit payment
    public function submit_payment_receipt(Order $order, Request $request)
    {
        $request->validate([
            'payment_receipt' => 'required|image|mimes:png,jpg, jpeg|max:10240',
        ]);

        $file = $request->file('payment_receipt');
        $path = time() . '_' . $order->id . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $order->update([
            'payment_receipt' => $path
        ]);

        return Redirect::back()->with(['success' =>'Berhasil diunggah']);
    }

    // fungsi untuk mengkonfirmasi pesanan atau confirm payment
    public function confirm_payment(Order $order)
    {
        $order->update([
            'is_paid' => true
        ]);

        return Redirect::back()->with(['success' =>'Pesanan dikonfirmasi!']);
    }

    // fungsi untuk nota transaksi
    public function nota(Order $order)
    {
        return view('order.nota', compact('order'));
    }
}
