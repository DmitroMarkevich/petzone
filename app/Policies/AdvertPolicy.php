<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Advert\Advert;

class AdvertPolicy
{
    /**
     * Determine if the given user can update the advert.
     *
     * @param User $user
     * @param Advert $advert
     * @return bool
     */
    public function update(User $user, Advert $advert): bool
    {
        return $user->id === $advert->user_id;
    }
}
