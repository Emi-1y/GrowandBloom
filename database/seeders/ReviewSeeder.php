<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users    = User::where('role', User::ROLE_USER)->get();
        $products = Product::where('active', true)->get();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        $comments = [
            'Excelente producto, muy recomendado.',
            'Llegó en perfectas condiciones y muy bien empacado.',
            'La planta está muy saludable, superó mis expectativas.',
            'Buena relación calidad-precio.',
            'El servicio de entrega fue rápido y eficiente.',
            'Producto tal como se describe, estoy satisfecho.',
            'La calidad podría mejorar un poco.',
            'Me encantó, ya pedí otro.',
            'Muy bonito y fácil de cuidar.',
            'Perfecto para regalar, quedé muy contento.',
        ];

        foreach ($products->take(8) as $product) {
            $reviewCount   = rand(2, 4);
            $selectedUsers = $users->random(min($reviewCount, $users->count()));

            foreach ($selectedUsers as $user) {
                Review::create([
                    'user_id'    => $user->getId(),
                    'product_id' => $product->getId(),
                    'rating'     => rand(3, 5),
                    'comment'    => $comments[array_rand($comments)],
                ]);
            }
        }
    }
}
