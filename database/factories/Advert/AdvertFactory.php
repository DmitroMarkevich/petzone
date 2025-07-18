<?php

namespace Database\Factories\Advert;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Advert\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advert\Advert>
 */
class AdvertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => 'Оголошення #' . $this->faker->unique()->randomNumber(5),
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(10, 5000),
            'is_active' => true,
        ];
    }
}
