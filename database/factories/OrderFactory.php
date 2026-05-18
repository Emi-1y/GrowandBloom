<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'total' => 0,
            'payment_method' => fake()->randomElement(['cash', 'card', 'transfer', 'nequi']),
            'status' => fake()->randomElement([Order::STATUS_PENDING, Order::STATUS_COMPLETED, Order::STATUS_CANCELLED]),
            'payment_status' => fake()->randomElement([Order::PAYMENT_PENDING, Order::PAYMENT_PAID, Order::PAYMENT_FAILED]),
            'user_id' => User::where('role', User::ROLE_USER)->inRandomOrder()->first()?->getId() ?? User::factory(),
        ];
    }
}
