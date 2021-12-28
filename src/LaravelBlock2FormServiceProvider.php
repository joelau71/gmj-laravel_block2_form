<?php

namespace GMJ\LaravelBlock2Form;

use GMJ\LaravelBlock2Form\View\Components\Frontend;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelBlock2FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php", 'LaravelBlock2Form');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'LaravelBlock2Form');
        $this->loadViewsFrom(__DIR__ . '/resources/views/config', 'LaravelBlock2FormConfig');

        Blade::component("LaravelBlock2Form", Frontend::class);

        $this->publishes([
            __DIR__ . '/config/laravel_block2_form_config.php' => config_path('gmj/laravel_block2_form_config.php'),
            __DIR__ . '/database/seeders' => database_path('seeders'),
        ], 'GMJ\LaravelBlock2Form');
    }


    public function register()
    {
    }
}
