<?php

namespace App\Services\Profile;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class WishlistService
{
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
        $paginator->getCollection()->each(fn($advert) => $advert->in_wishlist = true);

        return $paginator;
    }

    public function toggleWishlist(User $user, string $advertId): bool
    {
        $result = $user->wishlist()->toggle($advertId);

        return !empty($result['attached']);
    }
}
