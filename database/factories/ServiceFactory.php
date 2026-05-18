<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'employee' => fake()->name(),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(50000, 500000),
            'duration' => fake()->randomElement(['1-2 horas', '2-4 horas', '4-6 horas', '1 día', '1-2 días']),
            'active' => true,
            'features' => json_encode(fake()->sentences(fake()->numberBetween(2, 5))),
            'image' => null,
        ];
    }
}
