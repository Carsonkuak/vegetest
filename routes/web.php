<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;

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
