<?php

use App\Http\Controllers\Checkout\DeliveryController;
use App\Http\Controllers\Profile\AddressController;
use Illuminate\Support\Facades\Route;

Route::prefix('address')->name('address.')->group(function () {
    Route::get('/cities', [AddressController::class, 'searchCities'])->name('cities');
    Route::get('/streets', [AddressController::class, 'searchStreets'])->name('streets');
    Route::get('/warehouses', [DeliveryController::class, 'getWarehouses'])->name('warehouses');
});
