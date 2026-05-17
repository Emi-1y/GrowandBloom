<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'    => User::where('role', User::ROLE_USER)->inRandomOrder()->first()?->getId() ?? User::factory(),
            'product_id' => Product::where('active', true)->inRandomOrder()->first()?->getId() ?? 1,
            'rating'     => fake()->numberBetween(1, 5),
            'comment'    => fake()->boolean(80) ? fake()->paragraph() : null,
        ];
    }
}
