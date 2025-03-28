<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Collection;

class OrderService
{
    /**
     * Save a new order in the database.
     *
     * @param array $data
     * @return Order
     */
    public function createOrder(array $data): Order
    {
        return Order::create([
            'buyer_id' => auth()->id(),
            'advert_id' => $data['advert_id'],
            'delivery_method' => $data['delivery_method'],
            'payment_method' => $data['payment_method'] ?? null,
            'order_number' => $this->generateOrderNumber(),
        ]);
    }

    /**
     * Get the user's orders based on their active status.
     *
     * @param bool $isActive
     * @return Collection
     */
    public function getUserOrders(bool $isActive): Collection
    {
        return auth()->user()->orders()->where('is_active', $isActive)->get();
    }

    /**
     * Generate a unique order number.
     *
     * @return string
     */
    public function generateOrderNumber(): string
    {
        return 'ORD-' . strtoupper(uniqid());
    }
}
