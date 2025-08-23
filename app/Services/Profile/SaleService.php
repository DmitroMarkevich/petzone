<?php

namespace App\Services\Profile;

use App\Models\User;
use App\Models\Order;
use App\Enum\OrderStatus;
use Illuminate\Pagination\LengthAwarePaginator;

class SaleService
{
    /**
     * Get a paginated list of the user's orders filtered by active status.
     *
     * @param User $user The user whose sales to retrieve.
     * @param bool $isActive Filter orders by active status.
     * @param int $perPage Number of orders per page. Default is 10.
     * @return LengthAwarePaginator Paginated collection of orders.
     */
    public function getUserSales(User $user, bool $isActive, int $perPage = 10): LengthAwarePaginator
    {
        return $user->sales()
            ->whereHas('advert', fn($q) => $q->where('is_active', $isActive))
            ->where('status', '!=', OrderStatus::PROCESSING->value)
            ->with(['advert' => fn($q) => $q->withMainImage(), 'buyer'])
            ->orderByRaw("status = ? DESC", [OrderStatus::PENDING->value])
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Update the status of an order.
     *
     * @param Order $order The order to update.
     * @param OrderStatus $status The new order status (pending, confirmed ...) to set.
     * @return void
     */
    public function updateOrderStatus(Order $order, OrderStatus $status): void
    {
        if ($order->status !== $status) {
            $order->update(['status' => $status]);
        }
    }
}
