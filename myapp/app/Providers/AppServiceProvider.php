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
        $path = __DIR__;
        require_once $path. '/../Http/Helpers/function.php';
        require_once $path. '/../Http/Helpers/EmailHelpers.php';
        require_once $path. '/../Http/Helpers/MyCustomException.php';
    }
}
