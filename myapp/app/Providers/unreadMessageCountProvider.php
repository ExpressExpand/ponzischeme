<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class unreadMessageCountProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['partials/admin/_messaging',
         'partials/_messaging'], 'App\Http\ViewComposers\UnReadMessageComposer');
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
