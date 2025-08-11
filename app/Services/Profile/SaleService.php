<?php

namespace App\Services\Profile;

use App\Models\User;
use App\Enum\OrderStatus;
use Illuminate\Pagination\LengthAwarePaginator;

class SaleService
{
    /**
     * Get the user's orders based on their active status.
     *
     * @param User $user
     * @param bool $isActive
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getUserSales(User $user, bool $isActive, int $perPage = 10): LengthAwarePaginator
    {
        return $user->sales()
            ->whereHas('advert', function ($query) use ($isActive) {
                $query->where('is_active', $isActive);
            })->with('advert')
            ->orderByRaw("status = ? DESC", [OrderStatus::PENDING->value])
            ->latest()
            ->paginate($perPage);
    }
}
