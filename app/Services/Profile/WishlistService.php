<?php

namespace App\Services\Profile;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class WishlistService
{
    /**
     * Get the list of a user's favorite advertisements.
     *
     * @param User $user The user whose wishlist to retrieve.
     * @param string|null $sort Sorting option key (optional).
     * @param int $perPage Number of adverts per page. Default is 10.
     * @return LengthAwarePaginator Paginated collection of adverts.
     */
    public function getUserWishlist(User $user, ?string $sort = null, int $perPage = 10): LengthAwarePaginator
    {
        $sortOptions = [
            'price-asc'  => fn($q) => $q->orderBy('price', 'asc'),
            'price-desc' => fn($q) => $q->orderBy('price', 'desc'),
            'date-asc'   => fn($q) => $q->orderBy('created_at', 'desc'),
        ];

        $builder = $user->wishlist()->withMainImage();

        if ($sort && isset($sortOptions[$sort])) {
            $builder = $sortOptions[$sort]($builder);
        } else {
            $builder = $builder->inRandomOrder();
        }

        $paginator = $builder->paginate($perPage)->withQueryString();
        $paginator->getCollection()->each(fn($advert) => $advert->inWishlist = true);

        return $paginator;
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
