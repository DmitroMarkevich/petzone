<?php

use App\Enum\OrderStatus;
use App\Http\Controllers\Profile\{
    ProfileController,
    OrderController,
    SalesController,
    WishlistController
};
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::patch('/update', [ProfileController::class, 'update'])->name('update');
    Route::post('/logo', [ProfileController::class, 'uploadAvatar'])->name('uploadAvatar');
    Route::delete('/logo', [ProfileController::class, 'deleteAvatar'])->name('deleteAvatar');

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/history', [OrderController::class, 'history'])->name('history');
        Route::get('/{id}', [OrderController::class, 'show'])->name('details');
    });

    Route::prefix('sales')->name('sales.')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('index');
        Route::post(
            '/{orderId}/confirm',
            fn($id) => app(SalesController::class)->updateStatus($id, OrderStatus::CONFIRMED)
        )->name('confirm');
        Route::post(
            '/{orderId}/reject',
            fn($id) => app(SalesController::class)->updateStatus($id, OrderStatus::CANCELED)
        )->name('reject');
    });

    Route::get('/adverts', [ProfileController::class, 'adverts'])->name('adverts');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
});
