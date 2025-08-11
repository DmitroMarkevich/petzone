<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Enum\OrderStatus;
use App\Models\Advert\Advert;
use App\Jobs\AutoCancelOrder;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    /**
     * Save a new order in the database.
     *
     * @param User $user
     * @param array $data
     * @return Order
     * @throws \Exception
     */
    public function createOrder(User $user, array $data): Order
    {
        $advert = Advert::findOrFail($data['advert_id']);

        if (Order::where('status', $advert->id)->where('status', OrderStatus::CONFIRMED->value)->exists()) {
            // todo
        }

        $order = Order::create([
            'advert_id' => $advert->id,
            'buyer_id' => $user->id,
            'seller_id' => $advert->owner_id,

            'total_price' => $advert->price,
            'status' => OrderStatus::PENDING,
            'order_number' => $this->generateOrderNumber(),
            'payment_method' => $data['payment_method'],
            'delivery_method' => $data['delivery_method'],

            'recipient_first_name' => $data['recipient_first_name'],
            'recipient_last_name' => $data['recipient_last_name'],
            'recipient_middle_name' => $data['recipient_middle_name'] ?? null,
            'recipient_phone_number' => $data['recipient_phone_number'],
        ]);

        AutoCancelOrder::dispatch($order->id)->delay(now()->addDays(3));

        return $order;
    }

    /**
     * Get the user's orders based on their active status.
     *
     * @param User $user
     * @param bool $isActive
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getUserOrders(User $user, bool $isActive, int $perPage = 10): LengthAwarePaginator
    {
        return $user->orders()
            ->with(['advert:id,title,price'])
            ->where('is_active', $isActive)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Generate a unique order number.
     *
     * @return string
     */
    public function generateOrderNumber(): string
    {
        do {
            $orderNumber = strtoupper(Str::random(8));
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }
}
