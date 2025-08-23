<?php

use App\Http\Controllers\Checkout\StripeWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/webhook/stripe', [StripeWebhookController::class, 'handle']);
