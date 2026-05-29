<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/remove/{id}', [CartController::class, 'remove']);
Route::post('/checkout', [CartController::class, 'checkout']);
Route::get('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

Route::middleware(['auth'])->group(function () {
    Route::post('/place-order', [OrderController::class, 'placeOrder']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}/track', [OrderController::class, 'track']);
    Route::get('/orders/{id}/invoice', [OrderController::class, 'downloadInvoice']);
    
  Route::get('/reviews', [ReviewController::class, 'index']);
Route::post('/reviews', [ReviewController::class, 'store']);
});