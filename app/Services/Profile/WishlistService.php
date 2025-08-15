<?php

namespace App\Services\Profile;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class WishlistService
{
    /**
     * Get the list of a user's favorite advertisements.
     *
     * @param User $user The user whose wishlist to retrieve.
     * @return Collection Collection of advertisements in the wishlist.
     */
    public function getWishlist(User $user): Collection
    {
        return $user->wishlist()->get();
    }

    /**
     * Toggle an advertisement's presence in the user's wishlist.
     *
     * @param User $user The user whose wishlist to update.
     * @param string $advertId The ID of the advertisement to toggle.
     * @return bool True if ad is now in wishlist, false if removed
     */
    public function toggleWishlist(User $user, string $advertId): bool
    {
        $result = $user->wishlist()->toggle($advertId);

        return !empty($result['attached']);
    }
}
