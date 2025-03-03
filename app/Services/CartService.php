<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCartItems()
    {
        return Cart::where('user_id', Auth::id())->with('adverts')->get();
    }

    public function addToCart(int $advertId): bool
    {
        $userId = Auth::id();

        if ($this->isItemInCart($advertId)) {
            return false;
        }

        Cart::create(['user_id' => $userId, 'advert_id' => $advertId]);

        return true;
    }

    public function removeFromCart(int $advertId): void
    {
        Cart::where('user_id', Auth::id())->where('advert_id', $advertId)->delete();
    }

    private function isItemInCart(int $advertId): bool
    {
        return Cart::where('user_id', Auth::id())->where('advert_id', $advertId)->exists();
    }
}
