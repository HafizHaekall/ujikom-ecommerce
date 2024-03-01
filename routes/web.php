<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ProductController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('admin')->name('dashboard');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Home Product
Route::get('/home', [ProductController::class, 'index'])->name('home');

// Create Product
Route::get('/product/create', [ProductController::class, 'create'])->name('create_product');
Route::post('/product/create', [ProductController::class, 'store'])->name('store_product');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('show_product');
Route::patch('/product/{product}/update', [ProductController::class, 'update_product'])->name('update_product');

// Cart
Route::post('/cart/{product}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('/cart', [CartController::class, 'show_cart'])->name('cart');
Route::patch('/cart/{cart}', [CartController::class, 'update_cart'])->name('update_cart');
