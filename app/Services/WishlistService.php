<?php

namespace App\Services;

use App\Models\Advert\Advert;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;

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
     * Add an ad to the wishlist.
     *
     * @param string $advertId ID of the advertisement
     * @return void
     */
    public function addToWishlist(string $advertId): void
    {
        $wishlist = Session::get('wishlist', []);

        if (!$this->isInWishlist($advertId)) {
            $wishlist[] = $advertId;

            Session::put('wishlist', $wishlist);
        }
    }

    /**
     * Remove an ad from the wishlist.
     *
     * @param string $advertId ID of the advertisement
     * @return void
     */
    public function removeFromWishlist(string $advertId): void
    {
        $wishlist = Session::get('wishlist', []);

        $wishlist = array_diff($wishlist, [$advertId]);

        Session::put('wishlist', array_values($wishlist));
    }

    /**
     * Check if an ad is in the wishlist.
     *
     * @param string $advertId ID of the advertisement
     * @return bool
     */
    public function isInWishlist(string $advertId): bool
    {
        return in_array($advertId, Session::get('wishlist', []), true);
    }
}
