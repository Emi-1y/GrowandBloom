<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users    = User::where('role', User::ROLE_USER)->get();
        $products = Product::where('active', true)->get();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        $statuses       = ['pending', 'paid', 'shipped', 'delivered', 'cancelled'];
        $paymentMethods = ['credit_card', 'debit_card', 'cash', 'transfer'];

        for ($i = 0; $i < 15; $i++) {
            $user = $users->random();

            $order = new Order;
            $order->setUserId($user->getId());
            $order->setPaymentMethod($paymentMethods[array_rand($paymentMethods)]);
            $order->setDate(date('Y-m-d', strtotime('-' . rand(0, 180) . ' days')));
            $order->setStatus($statuses[array_rand($statuses)]);
            $order->setTotal(0);
            $order->save();

            $total           = 0;
            $selectedProducts = $products->random(min(rand(1, 3), $products->count()));

            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 4);

                $item = new Item;
                $item->setOrderId($order->getId());
                $item->setProductId($product->getId());
                $item->setServiceId(null);
                $item->setItemType('product');
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->save();

                $total += $item->calculateSubTotal();
            }

            $order->setTotal($total);
            $order->save();
        }
    }
}
