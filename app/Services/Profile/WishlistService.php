<?php

namespace App\Services\Profile;

use App\Models\User;
use App\Enum\AdvertSortOption;
use Illuminate\Pagination\LengthAwarePaginator;

class WishlistService
{
    public function getUserWishlist(User $user, ?string $sort = null, int $perPage = 10): LengthAwarePaginator
    {
        $builder = $user->wishlist()->withMainImage();

        $sortOption = AdvertSortOption::tryFromRequest($sort);

        if ($sortOption) {
            $builder = $sortOption->apply($builder);
        } else {
            $builder = $builder->inRandomOrder();
        }

        $paginator = $builder->paginate($perPage)->withQueryString();
        $paginator->getCollection()->each(fn($advert) => $advert->in_wishlist = true);

        return $paginator;
    }

    public function toggleWishlist(User $user, string $advertId): bool
    {
        $result = $user->wishlist()->toggle($advertId);

        return !empty($result['attached']);
    }
}
