<?php

// Author: Emily Cardona Castañeda

namespace App\Utils;

use App\Interfaces\PaymentInterface;
use App\Models\Order;

class TransferPaymentService implements PaymentInterface
{
    public function process(Order $order): array
    {
        return [
            'type' => 'transfer',
            'bank' => 'Bancolombia',
            'account_type' => __('payment.savings_account'),
            'account_number' => '123-456789-00',
            'nit' => '900.123.456-7',
            'beneficiary' => 'Grow and Bloom S.A.S.',
            'amount_formatted' => $order->getFormattedTotal(),
            'reference' => 'PED-'.str_pad((string) $order->getId(), 6, '0', STR_PAD_LEFT),
            'order_id' => $order->getId(),
        ];
    }
}
