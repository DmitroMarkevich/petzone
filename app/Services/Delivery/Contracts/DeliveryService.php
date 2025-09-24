<?php

namespace App\Services\Delivery\Contracts;

use App\Models\Order\Order;
use App\Models\Order\OrderRecipient;

interface DeliveryService
{
    /**
     * Create shipment (TTN / tracking) for the order.
     */
    public function createTTN(Order $order, OrderRecipient $recipient): array;

    /**
     * Get estimated cost for shipment
     */
    public function calculatePrice(Order $order, OrderRecipient $recipient): float;

    /**
     * Optional: get list of available warehouses
     */
    public function getWarehouses(string $city, int $page = 1, ?string $warehouseRef = null): array;
}
