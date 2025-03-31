<?php

namespace Database\Factories;

use App\DeliveryMethod;
use App\Models\Advert\Advert;
use App\Models\User;
use App\OrderStatus;
use App\PaymentMethod;
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
            'status' => $this->faker->randomElement(OrderStatus::values()),
            'order_number' => strtoupper(Str::random(8)),
            'is_active' => $this->faker->boolean(),

            'tracking_number' => Str::random(10),
            'payment_method' => $this->faker->randomElement(PaymentMethod::values()),
            'delivery_cost' => $this->faker->randomFloat(2, 0, 150),
            'delivery_method' => $this->faker->randomElement(DeliveryMethod::values()),
            'estimated_delivery_date' => $this->faker->dateTimeBetween('+1 day', '+1 weeks'),
            'shipped_at' => $this->faker->optional()->dateTime(),
            'delivered_at' => $this->faker->optional()->dateTime(),
            'canceled_at' => $this->faker->optional()->dateTime(),
            'cancellation_reason' => $this->faker->optional()->sentence(),

            'buyer_id' => User::inRandomOrder()->first()->id,
            'advert_id' => Advert::inRandomOrder()->first()->id,
        ];
    }
}
