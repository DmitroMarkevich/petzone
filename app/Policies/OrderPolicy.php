<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order\Order;

class OrderPolicy
{
    /**
     * Determine if the given user can view the order.
     *
     * @param User $user The authenticated user.
     * @param Order $order The order being checked.
     * @return bool True if the user can view the order, false otherwise.
     */
    public function view(User $user, Order $order): bool
    {
        // ?todo check permission to view order by seller
        return $user->id === $order->buyer_id || $user->id === $order->seller_id;
    }
}
