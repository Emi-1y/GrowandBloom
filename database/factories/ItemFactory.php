<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        $product = Product::where('active', true)->inRandomOrder()->first();

        return [
            'quantity' => fake()->numberBetween(1, 5),
            'price' => $product?->getPrice() ?? fake()->numberBetween(5000, 200000),
            'order_id' => Order::inRandomOrder()->first()?->getId() ?? Order::factory(),
            'product_id' => $product?->getId(),
            'service_id' => null,
            'item_type' => 'product',
        ];
    }
}
