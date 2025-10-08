<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Advert\AdvertController;

Route::post('/advert/preview', [AdvertController::class, 'preview'])->name('advert.preview');
Route::resource('advert', AdvertController::class);
