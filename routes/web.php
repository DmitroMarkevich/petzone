<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Auth\OAuth2Controller;
use App\Http\Controllers\Advert\AdvertController;
use App\Http\Controllers\Profile\OrderController;
use App\Http\Controllers\Profile\SalesController;
use App\Http\Controllers\Profile\AddressController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\WishlistController;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Checkout\DeliveryController;
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

        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.details');
        Route::get('/orders-history', [OrderController::class, 'history'])->name('orders.history');

        Route::get('/sales', [SalesController::class, 'index'])->name('sales');
        Route::post('/sales/{id}/confirm', [SalesController::class, 'confirm'])->name('sales.confirm');

        Route::get('/adverts', [ProfileController::class, 'adverts'])->name('adverts');
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    });

    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/', [CheckoutController::class, 'store'])->name('store');
    });

    Route::prefix('wishlist')->name('wishlist.')->group(function () {
        Route::post('/toggle/{advertId}', [WishlistController::class, 'toggleWishlist'])->name('toggle');
    });
});

Route::prefix('auth')->group(function () {
    Route::get('callback/{provider}', [OAuth2Controller::class, 'handleProviderCallback']);
    Route::get('redirect/{provider}', [OAuth2Controller::class, 'redirectToProvider'])->name('social.login');
});
