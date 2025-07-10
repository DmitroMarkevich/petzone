<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Advert\Advert;

class WishlistService
{
    /**
     * Get the list of favorite ads.
     *
     * @return Collection
     */
    public function getWishlist(): Collection
    {
        $wishlistIds = Session::get('wishlist', []);

        return Advert::whereIn('id', $wishlistIds)->get();
    }

    /**
     * Toggle an ad's presence in the wishlist.
     *
     * @param string $advertId ID of the advertisement
     * @return void
     */
    public function toggleWishlist(string $advertId): void
    {
        $wishlist = Session::get('wishlist', []);

        if (in_array($advertId, $wishlist, true)) {
            $wishlist = array_filter($wishlist, fn($id) => $id !== $advertId);
        } else {
            $wishlist[] = $advertId;
        }

        Session::put('wishlist', array_values($wishlist));
    }
}
