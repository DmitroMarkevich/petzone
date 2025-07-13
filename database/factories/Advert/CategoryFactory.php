<?php

namespace Database\Factories\Advert;

use App\Models\Advert\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advert\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $parentId = null;

        if ($this->faker->boolean()) {
            $parentId = Category::inRandomOrder()->value('id');
        }

        return [
            'id' => Str::uuid(),
            'parent_id' => $parentId,
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->sentence,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
