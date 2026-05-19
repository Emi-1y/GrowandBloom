<?php

// Author: Emily Cardona Castañeda

namespace App\Interfaces;

use App\Models\Order;

interface PaymentInterface
{
    public function process(Order $order): array;
}
