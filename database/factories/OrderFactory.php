<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Advert\Advert;
use App\Enum\OrderStatus;
use App\Enum\PaymentMethod;
use App\Enum\DeliveryMethod;

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
            'order_number' => strtoupper(Str::random(8)),
            'status' => $this->faker->randomElement(OrderStatus::values()),
            'is_active' => $this->faker->boolean(),

            'buyer_id' => User::inRandomOrder()->first()->id,
            'advert_id' => Advert::inRandomOrder()->first()->id,

            'payment_method' => $this->faker->randomElement(PaymentMethod::values()),

            'delivery_method' => $this->faker->randomElement(DeliveryMethod::values()),
            'delivery_cost' => $this->faker->randomFloat(2, 0, 150),
            'total_price' => $this->faker->numberBetween(10, 5000),
            'tracking_number' => Str::random(10),
            'estimated_delivery_date' => $this->faker->dateTimeBetween('+1 day', '+1 weeks'),

            'shipped_at' => $this->faker->optional()->dateTime(),
            'delivered_at' => $this->faker->optional()->dateTime(),
            'canceled_at' => fake()->dateTimeBetween('now', '+1 month'),
            'cancellation_reason' => $this->faker->optional()->sentence(),
        ];
    }
}
