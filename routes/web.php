<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/products', function () {
    return view('products');
})->middleware('auth');

Route::get('/product-detail', function () {
    return view('product-detail');
})->middleware('auth');

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
Route::get('/products/category/{categorySlug}', [ProductController::class, 'index'])->name('products.category')->middleware('auth');
Route::get('/product-detail/{product}', [ProductController::class, 'show'])->name('products.show')->middleware('auth');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');

Route::get('/search', [ProductController::class, 'search'])->name('products.search')->middleware('auth');
