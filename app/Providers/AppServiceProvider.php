<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Packaging;
use App\Models\Product;
use App\Models\User;
use App\Observers\CustomerObserver;
use App\Observers\OrderObserver;
use App\Observers\PackagingObserver;
use App\Observers\ProductObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Customer::observe(CustomerObserver::class);
        Product::observe(ProductObserver::class);
        Packaging::observe(PackagingObserver::class);
        Order::observe(OrderObserver::class);
        User::observe(UserObserver::class);
    }
}
