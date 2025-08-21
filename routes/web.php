<?php

use App\Enum\OrderStatus;
use App\Http\Controllers\Advert\AdvertController;
use App\Http\Controllers\Auth\OAuth2Controller;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Checkout\DeliveryController;
use App\Http\Controllers\Checkout\StripeWebhookController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Profile\AddressController;
use App\Http\Controllers\Profile\OrderController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\SalesController;
use App\Http\Controllers\Profile\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('adverts', AdvertController::class);

    Route::prefix('address')->name('address.')->group(function () {
        Route::get('/cities', [AddressController::class, 'searchCities'])->name('cities');
        Route::get('/streets', [AddressController::class, 'searchStreets'])->name('streets');
        Route::get('/warehouses', [DeliveryController::class, 'getWarehouses'])->name('warehouses');
    });

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

    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/', [CheckoutController::class, 'store'])->name('store');

        Route::get('/success', [CheckoutController::class, 'success'])->name('success');
        Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('cancel');
    });

    Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle']);

    Route::prefix('wishlist')->name('wishlist.')->group(function () {
        Route::post('/toggle/{advertId}', [WishlistController::class, 'toggleWishlist'])->name('toggle');
    });
});

Route::prefix('auth')->group(function () {
    Route::get('callback/{provider}', [OAuth2Controller::class, 'handleProviderCallback']);
    Route::get('redirect/{provider}', [OAuth2Controller::class, 'redirectToProvider'])->name('social.login');
});
