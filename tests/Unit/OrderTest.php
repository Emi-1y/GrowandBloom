<?php

// Author: Emily Cardona Castañeda

namespace Tests\Unit;

use App\Models\Order;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrderTest extends TestCase
{
    #[Test]
    public function place_order_sets_status_to_pending(): void
    {
        $order = new Order;
        $order->placeOrder();

        $this->assertEquals(Order::STATUS_PENDING, $order->getStatus());
    }

    #[Test]
    public function place_order_sets_payment_status_to_pending(): void
    {
        $order = new Order;
        $order->placeOrder();

        $this->assertEquals(Order::PAYMENT_PENDING, $order->getPaymentStatus());
    }
}
