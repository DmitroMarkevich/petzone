<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\OAuth2Controller;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

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

        Route::get('/orders', [ProfileController::class, 'orders'])->name('orders');
        Route::get('/orders/{id}', [ProfileController::class, 'orderDetails'])->name('orders.details');
        Route::get('/orders-history', [ProfileController::class, 'ordersHistory'])->name('orders.history');

        Route::get('/sales', [ProfileController::class, 'sales'])->name('sales');
        Route::get('/adverts', [ProfileController::class, 'adverts'])->name('adverts');
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    });

    Route::prefix('wishlist')->name('wishlist.')->group(function () {
        Route::post('/toggle/{id}', [WishlistController::class, 'toggleWishlist'])->name('toggle');
    });
});

Route::prefix('auth')->group(function () {
    Route::get('callback/{provider}', [OAuth2Controller::class, 'handleProviderCallback']);
    Route::get('redirect/{provider}', [OAuth2Controller::class, 'redirectToProvider'])->name('social.login');
});
