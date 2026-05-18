<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'size' => fake()->randomElement(['Pequeña', 'Mediana', 'Grande', 'Talla única']),
            'brand' => fake()->company(),
            'price' => fake()->numberBetween(5000, 200000),
            'exclusive' => fake()->boolean(20),
            'image' => null,
            'description' => fake()->paragraph(),
            'color' => fake()->safeColorName(),
            'discount' => fake()->randomElement([0, 0, 0, 5, 10, 15]),
            'active' => true,
            'stock' => fake()->numberBetween(5, 100),
            'category_id' => Category::inRandomOrder()->first()?->getId() ?? Category::factory(),
        ];
    }
}
