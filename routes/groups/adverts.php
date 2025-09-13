<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Advert\AdvertController;

Route::resource('advert', AdvertController::class);
