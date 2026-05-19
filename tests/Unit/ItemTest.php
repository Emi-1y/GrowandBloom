<?php

// Author: Emily Cardona Castañeda

namespace Tests\Unit;

use App\Models\Item;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ItemTest extends TestCase
{
    #[Test]
    public function calculate_sub_total_returns_quantity_times_unit_price(): void
    {
        $item = new Item;
        $item->setQuantity(3);
        $item->setUnitPrice(25000);

        $this->assertEquals(75000, $item->calculateSubTotal());
    }

    #[Test]
    public function calculate_sub_total_with_quantity_one_returns_unit_price(): void
    {
        $item = new Item;
        $item->setQuantity(1);
        $item->setUnitPrice(180000);

        $this->assertEquals(180000, $item->calculateSubTotal());
    }
}
