<?php

namespace App\Services\Profile;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class WishlistService
{
    /**
     * Get the list of favorite ads for a given user ID.
     *
     * @param User $user
     * @return Collection
     */
    public function getWishlist(User $user): Collection
    {
        return $user->wishlist()->get();
    }

    /**
     * Toggle an ad's presence in the wishlist.
     *
     * @param User $user
     * @param string $advertId ID of the advertisement
     * @return bool True if ad is now in wishlist, false if removed
     */
    public function toggleWishlist(User $user, string $advertId): bool
    {
        $result = $user->wishlist()->toggle($advertId);

        return !empty($result['attached']);
    }
}
