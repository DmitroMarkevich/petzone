<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Order;
use App\Enum\OrderStatus;
use App\Models\Advert\Advert;
use App\Jobs\AutoCancelOrder;

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

        $order = Order::create([
            'advert_id' => $advertId,
            'total_price' => $advert->price,
            'status' => OrderStatus::PENDING,
            'payment_method' => $data['payment_method'],
            'delivery_method' => $data['delivery_method'],
            'order_number' => $this->generateOrderNumber(),
            'buyer_id' => auth()->id(),
        ]);

        AutoCancelOrder::dispatch($order->id)->delay(now()->addDays(3));

        return $order;
    }

    /**
     * Get the user's orders based on their active status.
     *
     * @param bool $isActive
     * @return Collection
     */
    public function getUserOrders(bool $isActive): Collection
    {
        return auth()->user()
            ->orders()
            ->where('is_active', $isActive)
            ->orderByDesc('created_at')
            ->get();
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
