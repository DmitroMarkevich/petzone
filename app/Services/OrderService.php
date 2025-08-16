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
     * Create and save a new order in the database.
     *
     * @param User $user The user who is placing the order.
     * @param array $data The data required to create the order
     * @return Order The newly created order instance.
     * // TODO
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
     * Get a paginated list of the user's orders filtered by active status.
     *
     * @param User $user The user whose orders to retrieve.
     * @param bool $isActive Filter orders by active status.
     * @param int $perPage Number of orders per page. Default is 10.
     * @return LengthAwarePaginator Paginated collection of the user's orders.
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
     * Get a single order by its ID with all necessary relationships loaded.
     *
     * @param string $orderId The ID of the order to retrieve.
     * @return Order The order model instance with related buyer, seller, and advert images.
     */
    public function getOrderById(string $orderId): Order
    {
        return Order::with([
            'buyer', 'seller',
            'advert' => fn($query) => $query->withMainImage()
        ])->findOrFail($orderId);
    }

    /**
     * Generate a unique order number for a new order.
     *
     * @return string The generated unique order number.
     */
    public function generateOrderNumber(): string
    {
        do {
            $orderNumber = strtoupper(Str::random(8));
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }
}
