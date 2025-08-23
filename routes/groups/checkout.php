<?php

use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Checkout\StripeWebhookController;
use Illuminate\Support\Facades\Route;

Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'store'])->name('store');

    Route::get('/success', [CheckoutController::class, 'success'])->name('success');
    Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('cancel');
});

Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle']);
