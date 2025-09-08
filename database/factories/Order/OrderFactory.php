<?php

namespace Database\Factories\Order;

use App\Models\Order\Order;
use App\Models\User;
use App\Enum\OrderStatus;
use App\Enum\PaymentMethod;
use App\Enum\DeliveryMethod;
use App\Models\Advert\Advert;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order\Order>
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
        $buyer = User::inRandomOrder()->first();
        $advert = Advert::inRandomOrder()->first();

        return [
            'order_number' => strtoupper(Str::random(8)),
            'status' => $this->faker->randomElement(OrderStatus::values()),

            'advert_id' => $advert->id,
            'buyer_id' => $buyer->id,
            'seller_id' => $advert->owner_id,

            'payment_method' => $this->faker->randomElement(PaymentMethod::values()),
            'delivery_method' => $this->faker->randomElement(DeliveryMethod::values()),

            'tracking_number' => Str::random(10),
            'total_price' => $this->faker->numberBetween(10, 5000),
            'delivery_cost' => $this->faker->randomFloat(2, 50, 300),
            'estimated_delivery_date' => $this->faker->dateTimeBetween('+1 day', '+1 weeks'),

            'shipped_at' => $this->faker->optional()->dateTimeBetween('now', '+2 weeks'),
            'delivered_at' => $this->faker->optional()->dateTimeBetween('now', '+1 month'),
            'canceled_at' => $this->faker->optional()->dateTimeBetween('now', '+1 month'),

            'cancellation_reason' => $this->faker->optional()->sentence(),

            'is_active' => $this->faker->boolean(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            $order->recipient()->create([
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'middle_name' => fake()->optional()->firstName(),
                'phone_number' => fake()->phoneNumber(),
            ]);
        });
    }
}
