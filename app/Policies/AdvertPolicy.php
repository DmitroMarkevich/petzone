<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Advert\Advert;

class AdvertPolicy
{
    /**
     * Determine if the given user can update the advert.
     *
     * @param User $user The authenticated user.
     * @param Advert $advert The advert to check.
     * @return bool True if the user can update the advert, false otherwise.
     */
    public function update(User $user, Advert $advert): bool
    {
        return $user->id === $advert->owner_id;
    }

    /**
     * Determine if the given user can delete the advert.
     *
     * @param User $user The authenticated user.
     * @param Advert $advert The advert to check.
     * @return bool True if the user can delete the advert, false otherwise.
     */
    public function delete(User $user, Advert $advert): bool
    {
        return $user->id === $advert->owner_id;
    }
}
