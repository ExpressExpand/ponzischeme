<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function()
        {
            // Do some task...
            //here we want to ban the users


        })->hourlyAt(120);
        
        $schedule->command('queue:work')->cron('* * * * * *');

                // Run every 5 minutes
        // $schedule->command('queue:work')->everyFiveMinutes();

        // // Run once a day
        // $schedule->command('queue:work')->daily();

        // // Run Mondays at 8:15am
        // $schedule->command('queue:work')->weeklyOn(1, '8:15');
        // php /path/to/artisan schedule:run 1>> /dev/null 2>&1
    }
    

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
