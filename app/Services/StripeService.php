<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Advert\Advert;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripeService
{
    /**
     * Construct the service and set Stripe secret.
     */
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe Checkout session for a given advert and order.
     *
     * @param Advert $advert The advert to be purchased.
     * @param Order $order The order associated with this checkout session.
     * @return StripeSession The created Stripe Checkout session object.
     * @throws \Stripe\Exception\ApiErrorException If the Stripe API request fails.
     */
    public function createCheckoutSession(Advert $advert, Order $order): StripeSession
    {
        return StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'uah',
                        'product_data' => ['name' => $advert->title],
                        'unit_amount' => (int)round($advert->price * 100),
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
            'metadata' => [
                'order_id' => $order->id,
            ],
        ]);
    }
}
