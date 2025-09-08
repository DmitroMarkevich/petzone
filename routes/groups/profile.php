<?php

use App\Enum\OrderStatus;
use App\Models\Order\Order;
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
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    });

    Route::prefix('sales')->name('sales.')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('index');
        Route::post('/{order}/confirm',
            fn(Order $order) => app(SalesController::class)->updateStatus($order, OrderStatus::CONFIRMED)
        )->name('confirm');

        Route::post('/{order}/reject',
            fn(Order $order) => app(SalesController::class)->updateStatus($order, OrderStatus::CANCELED)
        )->name('reject');
    });

    Route::get('/adverts', [ProfileController::class, 'adverts'])->name('adverts');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
});
