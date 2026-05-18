<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Order;
use App\Models\Plant;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', User::ROLE_USER)->get();
        $plants = Plant::where('active', true)->get();

        if ($users->isEmpty() || $plants->isEmpty()) {
            return;
        }

        $statuses = [Order::STATUS_PENDING, Order::STATUS_COMPLETED, Order::STATUS_CANCELLED];
        $paymentStatuses = [Order::PAYMENT_PENDING, Order::PAYMENT_PAID, Order::PAYMENT_FAILED];
        $paymentMethods = ['cash', 'card', 'transfer', 'nequi'];

        for ($i = 0; $i < 15; $i++) {
            $user = $users->random();

            $order = new Order;
            $order->setUserId($user->getId());
            $order->setPaymentMethod($paymentMethods[array_rand($paymentMethods)]);
            $order->setStatus($statuses[array_rand($statuses)]);
            $order->setPaymentStatus($paymentStatuses[array_rand($paymentStatuses)]);
            $order->setTotal(0);
            $order->save();

            $total = 0;
            $selectedPlants = $plants->random(min(rand(1, 3), $plants->count()));

            foreach ($selectedPlants as $plant) {
                $quantity = rand(1, 4);

                $item = new Item;
                $item->setOrderId($order->getId());
                $item->setPlantId($plant->getId());
                $item->setServiceId(null);
                $item->setQuantity($quantity);
                $item->setUnitPrice($plant->getPrice());
                $item->save();

                $total += $item->calculateSubTotal();
            }

            $order->setTotal($total);
            $order->save();
        }
    }
}
