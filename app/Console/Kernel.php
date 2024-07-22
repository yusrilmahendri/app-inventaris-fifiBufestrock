<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\LeadTimeCommand;
use Illuminate\Support\Debug\Dumper;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('inspire')->hourly();
        $schedule->command('reminders:send')->daily();
        $schedule->command('reminders:send')->everyMinute();
        // $schedule->command('reminders:send')->dailyAt('08:00');
    }


    /**
     * Register the commands for the application.
     */
    protected $commands = [
        LeadTimeCommand::class,
    ];
    // crontab -e
    // take in terminal crontab - e here
    # * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

}
