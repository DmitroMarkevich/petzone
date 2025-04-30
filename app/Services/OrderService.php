<?php

namespace App\Services;

use App\Models\Order;
use App\Enum\OrderStatus;
use App\Models\Advert\Advert;
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
        $advertId = $data['advert_id'];
        $advert = Advert::findOrFail($advertId);

        return Order::create([
            'buyer_id' => auth()->id(),
            'advert_id' => $advertId,
            'status' => OrderStatus::PENDING,
            'total_price' => $advert->price,
            'payment_method' => $data['payment_method'],
            'delivery_method' => $data['delivery_method'],
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
