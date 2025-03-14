<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    /**
     * Get the user's orders based on their active status.
     *
     * @param bool $isActive
     * @return Collection
     */
    public function getUserOrders(bool $isActive): Collection
    {
        return Auth::user()->orders()->where('is_active', $isActive)->get();
    }
}
