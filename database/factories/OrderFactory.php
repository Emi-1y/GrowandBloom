<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'total' => 0,
            'payment_method' => fake()->randomElement(['credit_card', 'debit_card', 'cash', 'transfer']),
            'date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'status' => fake()->randomElement(['pending', 'paid', 'shipped', 'delivered', 'cancelled']),
            'user_id' => User::where('role', User::ROLE_USER)->inRandomOrder()->first()?->getId() ?? User::factory(),
        ];
    }
}
