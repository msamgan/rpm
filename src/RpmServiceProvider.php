<?php

namespace Msamgan\Rpm;

use Illuminate\Support\ServiceProvider;

class RpmServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'rpm');

        $this->publishes([
            __DIR__.'/Resources/Assets' => public_path('Rpm/Assets'),
        ], 'public');
    }
}
