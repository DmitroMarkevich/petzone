<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Advert\Advert;

class AdvertPolicy
{
    /**
     * Determine if the given user can update the advert.
     */
    public function update(User $user, Advert $advert): bool
    {
        return $user->id === $advert->owner_id;
    }

    /**
     * Determine if the given user can delete the advert.
     */
    public function delete(User $user, Advert $advert): bool
    {
        return $user->id === $advert->owner_id;
    }
}
