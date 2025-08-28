<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileDetailsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BookOrderController;
use App\Http\Controllers\OrderController;

// Homepage
Route::get('/', [BookController::class, 'index'])->name('home');

// Book details
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Issue a book (requires login)
Route::post('/books/{id}/issue', [BookController::class, 'issue'])->name('books.issue')->middleware('auth');

// My Orders
Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index')->middleware('auth');


use App\Http\Controllers\MembershipController;
Route::get('/membership/plans', [MembershipController::class, 'index'])->name('membership.plans');


Route::post('/membership/subscribe/{plan}', [MembershipController::class, 'subscribe'])
    ->name('membership.subscribe')
    ->middleware('auth');
// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileDetailsController::class, 'show'])->name('profiledetails.show');
    Route::get('/profile/edit', [ProfileDetailsController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileDetailsController::class, 'update'])->name('profile.update');


Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{book}', [CartController::class, 'updateQty'])->name('cart.update');
Route::delete('/cart/remove/{book}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon');

});

use App\Http\Controllers\CheckoutController;

// Cart / Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');


Route::post('/books/return/{book}', [BookController::class, 'returnBook'])->name('books.return');

Route::get('/membership/subscribe/{plan}', [MembershipController::class, 'subscribe'])->name('membership.subscribe');

Route::post('/book-order', [BookOrderController::class, 'store'])
    ->name('book.order.store')
    ->middleware('auth');

Route::delete('/orders/clear', [App\Http\Controllers\BookOrderController::class, 'clearHistory'])
    ->name('orders.clear');


// Auth routes (Breeze)
require __DIR__.'/auth.php';
