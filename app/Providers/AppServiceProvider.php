<?php

namespace App\Providers;

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
        if ($this->app->environment('local','testing')) {  
            $this->app->register(\Laravel\Dusk\DuskServiceProvider::class);  
        }  
        if ($this->app->environment('local')) {  
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);  
            if (! class_exists('Debugbar')) {  
                class_alias('Barryvdh\Debugbar\Facade', 'Debugbar');  
            }  
        }
        //
    }
}
