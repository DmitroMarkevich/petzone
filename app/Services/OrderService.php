<?php

namespace App\Services;

use App\DTO\OrderData;
use App\DTO\RecipientData;
use App\Models\User;
use App\Models\Order\Order;
use App\Models\Advert\Advert;
use App\Enum\OrderStatus;
use App\Enum\PaymentMethod;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    /**
     * Create a new order for the given buyer, advert, and recipient.
     *
     * @param User $buyer The user who places the order.
     * @param OrderData $orderData Data Transfer Object containing order details.
     * @param RecipientData $recipientData Data Transfer Object containing recipient details.
     * @return Order The newly created order instance.
     */
    public function createOrder(User $buyer, OrderData $orderData, RecipientData $recipientData): Order
    {
        $advert = Advert::findOrFail($orderData->advert_id);

        $status = match ($orderData->payment_method) {
            PaymentMethod::CREDIT_CARD->value => OrderStatus::PROCESSING,
            PaymentMethod::CASH_ON_DELIVERY->value => OrderStatus::PENDING,
        };

        $order = Order::create($orderData->toModelAttributes($buyer, $advert, $status));
        $order->recipient()->create($recipientData->toArray());

        return $order;
    }

    /**
     * Get a paginated list of the user's orders filtered by active status.
     *
     * @param User $user The user whose orders to retrieve.
     * @param bool $isActive Filter orders by active status.
     * @param int $perPage Number of orders per page. Default is 10.
     * @return LengthAwarePaginator Paginated collection of the user's orders.
     */
    public function getUserOrders(User $user, bool $isActive, int $perPage = 10): LengthAwarePaginator
    {
        return $user->orders()->where('is_active', $isActive)->latest()->paginate($perPage);
    }
}
