<?php

// Author: Emily Cardona Castañeda

namespace App\Providers;

use App\Interfaces\PaymentInterface;
use App\Utils\ChequePaymentService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PaymentInterface::class, function () {
            return new ChequePaymentService;
        });
    }
}
