<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Advert\AdvertController;

Route::resource('adverts', AdvertController::class);
