<?php

namespace Database\Factories;

use App\Models\User;
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
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'advert_id' => Advert::inRandomOrder()->first()->id ?? Advert::factory(),
        ];
    }
}
