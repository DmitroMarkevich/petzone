<?php

namespace App\Services\Profile;

use App\Models\User;
use App\Enum\OrderStatus;
use App\Models\Order\Order;
use Illuminate\Pagination\LengthAwarePaginator;

class SaleService
{
    /**
     * Get a list of the user's sales filtered by active status.
     */
    public function getUserSales(User $user, bool $isActive, ?string $status = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = $user->sales()->whereHas('advert', fn($q) => $q->where('is_active', $isActive))
            ->where('status', '!=', OrderStatus::PROCESSING->value)
            ->with([
                'recipient',
                'buyer:id,first_name,last_name',
                'advert' => fn($q) => $q->select('id', 'title')->withMainImage(),
            ]);

        if ($status) {
            $query->where('status', $status);
        }

        return $query->orderByRaw("status = ? DESC", [OrderStatus::PENDING->value])
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function updateOrderStatus(Order $order, OrderStatus $status): OrderStatus
    {
        if ($order->status !== $status) {
            $order->update(['status' => $status]);
        }

        return $order->status;
    }
}
