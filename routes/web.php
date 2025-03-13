<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\OAuth2Controller;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/adverts/search', [AdvertController::class, 'search'])->name('adverts.search');
    Route::resource('adverts', AdvertController::class);

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/orders', [ProfileController::class, 'orders'])->name('orders');
        Route::get('/adverts', [ProfileController::class, 'adverts'])->name('adverts');
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
        Route::get('/orders-history', [ProfileController::class, 'ordersHistory'])->name('orders-history');

        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
        Route::post('/logo', [ProfileController::class, 'uploadLogo'])->name('updateLogo');
        Route::delete('/logo', [ProfileController::class, 'removeLogo'])->name('deleteLogo');
    });

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::post('/add/{id}', [CartController::class, 'addToCart'])->name('add');
    });

    Route::prefix('wishlist')->name('wishlist.')->group(function () {
        Route::post('/add/{id}', [WishlistController::class, 'addToWishlist'])->name('add');
    });
});

Route::prefix('auth')->group(function () {
    Route::get('callback/{provider}', [OAuth2Controller::class, 'handleProviderCallback']);
    Route::get('redirect/{provider}', [OAuth2Controller::class, 'redirectToProvider'])->name('social.login');
});
