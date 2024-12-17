<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserextraController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;    
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
// use GuzzleHttp\Middleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/userprofile', function () {
    return view('home');
});

Route::get('/admin', [HomeController::class, 'admin'])->name('admin.admin');

// Products routes with explicit edit and delete
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');

Route::resource('userextra', UserextraController::class);

Route::resource('cart', CartController::class);
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::resource('home', HomeController::class);
Route::resource('orders', OrderController::class);

// Categories routes
Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// routes/web.php
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/shop-single/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/shop/all', [ShopController::class, 'all'])->name('shop.all');

Auth::routes();

// Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
// Route::resource('admin', ProductsController::class);

Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/about', [CartController::class, 'about'])->name('cart.about');
Route::get('/contact', [CartController::class, 'contact'])->name('cart.contact');
Route::get('/paypal/capture', [CartController::class, 'capturePayment'])->name('paypal.capture');
Route::post('/cart/save-order', [CartController::class, 'saveOrder'])->name('cart.save-order');
