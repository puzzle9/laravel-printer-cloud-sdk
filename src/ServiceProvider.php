<?php

namespace Puzzle9\PrinterCloudSdk;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/printersdk.php' => config_path('printersdk.php'),
        ], 'laravel-printersdk');
    }
    
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__) . '/src/printersdk.php', 'printersdk');
    }
}