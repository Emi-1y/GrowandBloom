<?php

// Author: Emily Cardona Castañeda

namespace App\Utils;

use App\Interfaces\PaymentInterface;
use App\Models\Order;

class ChequePaymentService implements PaymentInterface
{
    public function process(Order $order): array
    {
        return [
            'type' => 'cheque',
            'cheque_number' => str_pad((string) $order->getId(), 8, '0', STR_PAD_LEFT),
            'payable_to' => 'Grow and Bloom S.A.S.',
            'amount_formatted' => $order->getFormattedTotal(),
            'date' => now()->format('d/m/Y'),
            'memo' => __('payment.cheque_memo', ['id' => $order->getId()]),
            'order_id' => $order->getId(),
        ];
    }
}
