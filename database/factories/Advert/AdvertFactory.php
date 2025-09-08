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

    public function configure(): AdvertFactory|Factory
    {
        return $this->afterCreating(function ($advert) {
            $testImageUrl = 'adverts/9f95c0d0-f084-4f15-a378-ad95094abe37/qfkaJpt9Gm4giWoFbli4CB55YJ795CDJFVq8jgLe.jpg';
            $advert->images()->create(['image_path' => $testImageUrl, 'main_image' => true]);
        });
    }
}
