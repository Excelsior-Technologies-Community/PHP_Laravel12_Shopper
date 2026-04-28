<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;

Route::get('/', function () {
    return view('welcome');
});

// CART ROUTES
Route::get('/cpanel/products', [ProductController::class, 'index']);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/remove/{id}', [CartController::class, 'remove']);
Route::post('/checkout', [CartController::class, 'checkout']);
// WISHLIST
Route::get('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');