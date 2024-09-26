<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('/home', function () {
    return view('index');
})->name('home');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
Route::post('/register', [LoginController::class, 'register']);


Route::get('/products/create', [ProductController::class, 'create'])->name('create');

Route::post('/products/store', [ProductController::class, 'store'])->name('store');

Route::get('/products/list', [ProductController::class, 'getProductsList'])->name('products.list');

route::get('/products/{id}', [ProductController::class, 'show'])->name('show');

route::get('/cart/{user_id}', [CartController::class, 'viewCart'])->name('cart.view');

route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Route::get('/checkout/list', [CheckoutController::class, 'show'])->name('checkout.list');
Route::get('/checkout/list/{user_id}', [CheckoutController::class, 'show'])->name('checkoutlist');


route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart.delete');
