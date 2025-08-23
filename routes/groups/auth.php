<?php

use App\Http\Controllers\Auth\OAuth2Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get('callback/{provider}', [OAuth2Controller::class, 'handleProviderCallback']);
    Route::get('redirect/{provider}', [OAuth2Controller::class, 'redirectToProvider'])->name('social.login');
});
