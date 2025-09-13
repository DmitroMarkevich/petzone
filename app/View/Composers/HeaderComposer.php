<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HeaderComposer
{
    public function compose(View $view): void
    {
        $user = Auth::user();

        $wishlistCount = 0;
        $ordersCount = 0;

        if ($user) {
            $wishlistCount = $user->wishlist()->count();
            $ordersCount = $user->orders()->count();
        }

        $view->with([
            'wishlistCount' => $wishlistCount,
            'ordersCount' => $ordersCount,
        ]);
    }
}
