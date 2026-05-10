<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/category/{categorySlug}', [ProductController::class, 'index'])->name('products.category');


Route::get('/product-detail/{product}', [ProductController::class, 'show'])->name('products.show');




Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');


Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');


Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');


Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout/shipping', [CheckoutController::class, 'shipping'])->name('checkout.shipping')->middleware('auth');
Route::post('/checkout/shipping', [CheckoutController::class, 'storeShipping'])->name('checkout.shipping.store')->middleware('auth');
Route::get('/checkout/delivery', [CheckoutController::class, 'delivery'])->name('checkout.delivery')->middleware('auth');
Route::post('/checkout/delivery', [CheckoutController::class, 'storeDelivery'])->name('checkout.delivery.store')->middleware('auth');
Route::get('/checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm')->middleware('auth');

Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create')->middleware('auth');
Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.products.store')->middleware('auth');
Route::get('/admin/products/{product}/edit', [AdminController::class, 'edit'])->name('admin.products.edit')->middleware('auth');


Route::put('/admin/products/{product}', [AdminController::class, 'update'])->name('admin.products.update')->middleware('auth');


Route::delete('/admin/products/{product}', [AdminController::class, 'destroy'])->name('admin.products.destroy')->middleware('auth');
