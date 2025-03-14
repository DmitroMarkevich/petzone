<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Advert\Advert;
use App\Models\Advert\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advert>
 */
class AdvertFactory extends Factory
{
    protected $model = Advert::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'title' => 'Оголошення #' . $this->faker->unique()->randomDigitNotZero(),
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(10, 5000),
            'is_active' => true,
            'category_id' => Category::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
