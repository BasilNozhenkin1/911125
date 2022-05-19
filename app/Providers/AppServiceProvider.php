<?php

namespace App\Providers;

use App\Repositories\Product\EloquentProductQueries;
use App\Repositories\Product\ProductQueries;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductQueries::class,
            EloquentProductQueries::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
