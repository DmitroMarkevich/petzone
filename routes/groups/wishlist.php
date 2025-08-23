<?php

use App\Http\Controllers\Profile\WishlistController;
use Illuminate\Support\Facades\Route;

Route::prefix('wishlist')->name('wishlist.')->group(function () {
    Route::post('/toggle/{advertId}', [WishlistController::class, 'toggleWishlist'])->name('toggle');
});
