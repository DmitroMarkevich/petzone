<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
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
     * Get a single order by its ID with all necessary relationships loaded (buyer, seller, advert main image).
     *
     * @param string $orderId The ID of the order to retrieve.
     * @return Order The order model instance with related buyer, seller, and advert images.
     */
    public function getOrderByIdWithMainImage(string $orderId): Order
    {
        return Order::with([
            'buyer', 'seller',
            'advert' => fn($query) => $query->withMainImage()
        ])->findOrFail($orderId);
    }

//    /**
//     * Generate a unique order number for a new order.
//     *
//     * @return string The generated unique order number.
//     */
//    public function generateOrderNumber(): string
//    {
//        do {
//            $orderNumber = strtoupper(Str::random(8));
//        } while (Order::where('order_number', $orderNumber)->exists());
//
//        return $orderNumber;
//    }
}
