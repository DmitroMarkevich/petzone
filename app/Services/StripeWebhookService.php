<?php

namespace App\Services;

use App\Enum\OrderStatus;
use App\Models\Order\Order;
use Stripe\Event;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class StripeWebhookService
{
    private string $endpointSecret;

    /**
     * Construct the service and set Stripe webhook secret.
     */
    public function __construct()
    {
        $this->endpointSecret = config('services.stripe.webhook_secret');
    }

    /**
     * Construct a Stripe Event from the payload and signature header.
     *
     * @param string $payload Raw request payload from Stripe.
     * @param string $sigHeader Stripe-Signature header.
     * @throws SignatureVerificationException If signature is invalid.
     */
    public function constructEvent(string $payload, string $sigHeader): Event
    {
        return Webhook::constructEvent($payload, $sigHeader, $this->endpointSecret);
    }

    /**
     * Process a Stripe Event and update order status if applicable.
     *
     * @param Event $event The Stripe Event object to handle.
     */
    public function handleEvent(Event $event): void
    {
        $orderId = $event->data->object->metadata['order_id'] ?? null;

        if ($event->type === 'checkout.session.completed' && $orderId) {
            $order = Order::find($orderId);
            if ($order) {
                $order->update(['status' => OrderStatus::PENDING]);
            }
        }
    }
}
