<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'status' => 'pending',
            'total_price' => $this->faker->numberBetween(500, 10000),
            'tracking_number' => Str::random(10),
            'order_number' => strtoupper(Str::random(8)),
            'is_active' => $this->faker->boolean(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
