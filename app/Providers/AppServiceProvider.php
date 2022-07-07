<?php

namespace App\Providers;

use App\Models\TransactionProductPivot;
use App\Observers\TransactionProductPivotObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TransactionProductPivot::observe(TransactionProductPivotObserver::class);
    }
}
