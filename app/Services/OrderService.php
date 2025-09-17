<?php

namespace App\Services;

use App\DTO\OrderData;
use App\DTO\RecipientData;
use App\Models\User;
use App\Models\Order\Order;
use App\Models\Advert\Advert;
use App\Enum\OrderStatus;
use App\Enum\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    public function createOrder(User $buyer, OrderData $orderData, RecipientData $recipientData): Order
    {
        $advert = Advert::findOrFail($orderData->advert_id);

        // For card payments wait Stripe confirmation, for self pickup payment not needed.
        $status = match ($orderData->payment_method) {
            PaymentMethod::CREDIT_CARD->value => OrderStatus::PROCESSING,
            PaymentMethod::CASH_ON_DELIVERY->value => OrderStatus::PENDING,
        };

        return DB::transaction(function () use ($buyer, $orderData, $recipientData, $advert, $status) {
            $order = Order::create($orderData->toModelAttributes($buyer, $advert, $status));
            $order->recipient()->create($recipientData->toArray());
            return $order;
        });
    }

    public function getUserOrders(User $user, bool $isActive, int $perPage = 10): LengthAwarePaginator
    {
        return $user->orders()
            ->where('is_active', $isActive)
            ->latest()
            ->paginate($perPage);
    }
}
