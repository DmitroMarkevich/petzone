<?php

namespace Database\Factories\Advert;

use App\Models\User;
use App\Models\Advert\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $currentPrice = $this->faker->numberBetween(10, 5000);
        $hasPreviousPrice = $this->faker->boolean(30);

        $previousPrice = null;
        $priceChangedAt = null;

        if ($hasPreviousPrice) {
            $discountPercent = $this->faker->numberBetween(10, 50);
            $previousPrice = $currentPrice + ($currentPrice * $discountPercent / 100);
            $priceChangedAt = $this->faker->dateTimeBetween('-3 months', '-1 day');
        }

        return [
            'owner_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,

            'title' => 'Оголошення #' . $this->faker->unique()->randomNumber(5),
            'description' => $this->faker->paragraphs(rand(2, 4), true),
            'average_rating' => $this->faker->randomFloat(1, 0, 5),
            'price' => $currentPrice,
            'previous_price' => $previousPrice,
            'price_changed_at' => $priceChangedAt,
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
