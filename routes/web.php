<?php

use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    require __DIR__.'/groups/adverts.php';
    require __DIR__.'/groups/address.php';
    require __DIR__.'/groups/profile.php';
    require __DIR__.'/groups/checkout.php';
    require __DIR__.'/groups/wishlist.php';
});

require __DIR__.'/groups/auth.php';

Route::fallback(function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    abort(404);
});
