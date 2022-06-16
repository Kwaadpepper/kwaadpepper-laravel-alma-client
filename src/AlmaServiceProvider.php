<?php

namespace Kwaadpepper\AlmaClient;

use Illuminate\Support\ServiceProvider;

class AlmaServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            sprintf('%s/../config/alma-client.php', __DIR__),
            'alma-client'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config' => config_path(),
        ], 'config');

        // * ALMA CLient Singleton
        $this->app->singleton('AlmaClient', function () {
            return new Client();
        });
    }
}
