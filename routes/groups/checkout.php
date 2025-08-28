<?php

use App\Http\Controllers\Checkout\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::post('/select', [CheckoutController::class, 'select'])->name('select');
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'store'])->name('store');

    Route::get('/success', [CheckoutController::class, 'success'])->name('success');
    Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('cancel');
});
