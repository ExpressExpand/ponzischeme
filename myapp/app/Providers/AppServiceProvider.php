<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Helpers\AnalyticReports;
use Illuminate\Http\Request;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function (View $view) {
            $analytics = AnalyticReports::saveStats(request());
        });
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
        require_once $path. '/../Http/Helpers/ApplicationHelpers.php';
        require_once $path. '/../Http/Helpers/CustomFileAttachment.php';
        require_once $path. '/../Http/Helpers/AnalyticReports.php';
    }
}
