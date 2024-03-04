<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Redirect::route('home');
});
// Home Product
Route::get('/home', [ProductController::class, 'index'])->name('home');
// Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.index', [
            "active" => "dashboard",
        ]);
    })->name('dashboard');
    // Create Product
    Route::get('/product/create', [ProductController::class, 'create'])->name('create_product');
    Route::post('/product', [ProductController::class, 'store'])->name('store_product');
    Route::get('product/{product}/edit', [ProductController::class, 'edit'])->name('edit_product');
    Route::patch('/product/{product}/update', [ProductController::class, 'update'])->name('update_product');
    Route::delete('/product/{product}', [ProductController::class, 'delete_product'])->name('delete_product');
    // Konfirmasi Pesanan
    Route::patch('/order/{order}/confirm', [OrderController::class, 'confirm_payment'])->name('confirm_payment');
    // Nota Transaksi
    Route::get('/order/nota/{order}', [OrderController::class, 'nota'])->name('nota');
    // Profile Admin
    Route::get('/dashboard/profile', [ProfileController::class, 'admin'])->name('profile.admin');
});

Route::middleware(['auth'])->group(function () {
    // Cart
    Route::post('/cart/{product}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
    Route::get('/cart', [CartController::class, 'show_cart'])->name('cart');
    Route::get('/product/{product}', [ProductController::class, 'show'])->name('show_product');
    Route::patch('/cart/{cart}', [CartController::class, 'update_cart'])->name('update_cart');
    Route::delete('/cart/{cart}', [CartController::class, 'delete_cart'])->name('delete_cart');
    Route::get('/get-cart-amount/{cartId}', [CartController::class, 'getCartAmount']);
    // Checkout
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    // Order
    Route::get('/order', [OrderController::class, 'index_order'])->name('index_order');
    Route::get('/order/{order}', [OrderController::class, 'show_order'])->name('show_order');
    Route::post('/order/{order}/pay', [OrderController::class, 'submit_payment_receipt'])->name('submit_payment_receipt');
    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logout']);
});