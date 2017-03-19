<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials/_left_sidebar', 'App\Http\ViewComposers\SidebarComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
