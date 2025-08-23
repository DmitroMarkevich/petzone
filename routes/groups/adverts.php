<?php

use App\Http\Controllers\Advert\AdvertController;
use Illuminate\Support\Facades\Route;

Route::resource('adverts', AdvertController::class);
