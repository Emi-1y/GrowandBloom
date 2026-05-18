<?php

// Author: Emily Cardona Castañeda

namespace App\Providers;

use App\Models\Order;
use App\Policies\OrderPolicy;
use App\Services\CartService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CartService::class, function ($app) {
            return new CartService;
        });
    }

    public function boot(): void
    {
        Gate::policy(Order::class, OrderPolicy::class);
    }
}
