<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Wishlist;
use App\Models\Advert\Advert;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wishlist>
 */
class WishlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::inRandomOrder()->value('id') ?? User::factory();
        $advertId = Advert::query()
            ->whereNotIn('id', Wishlist::where('user_id', $userId)->pluck('advert_id'))
            ->inRandomOrder()
            ->value('id') ?? Advert::factory();

        return [
            'user_id' => $userId,
            'advert_id' => $advertId,
        ];
    }
}
