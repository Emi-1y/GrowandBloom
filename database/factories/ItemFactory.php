<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        $plant = Plant::where('active', true)->inRandomOrder()->first();

        return [
            'quantity' => fake()->numberBetween(1, 5),
            'unit_price' => $plant?->getPrice() ?? fake()->numberBetween(5000, 200000),
            'order_id' => Order::inRandomOrder()->first()?->getId() ?? Order::factory(),
            'plant_id' => $plant?->getId(),
            'service_id' => null,
        ];
    }
}
