<?php

namespace App\Providers;

use App\Support\CurrencyClient\Resources\FixerIOResource;
use App\Support\CurrencyClient\Resources\ResourcesInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ResourcesInterface::class, function($app)
        {
            return new FixerIOResource();
        });
    }
}
