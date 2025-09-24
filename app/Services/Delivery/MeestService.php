<?php

namespace App\Services\Delivery;

use App\Models\Order\Order;
use App\Models\Order\OrderRecipient;
use App\Services\Delivery\Contracts\DeliveryService;

class MeestService implements DeliveryService
{
    public function getWarehouses(string $cityRef, int $page = 1, string $warehouseRef = null): array
    {
        return [];
    }

    public function createTTN(Order $order, OrderRecipient $recipient): array
    {
        // TODO: Implement createTTN() method.
    }

    public function calculatePrice(Order $order, OrderRecipient $recipient): float
    {
        // TODO: Implement calculatePrice() method.
    }
}
