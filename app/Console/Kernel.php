<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     */
    protected $commands = [
        'App\Console\Commands\UnreadAnswer',
        'App\Console\Commands\DeleteQuestionAnswer',
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // Not Tested
        $schedule->command('notification:UnreadAnswer')
                ->withoutOverlapping()
                ->cron('0 0 */2 * *')
                ->timezone('Edinburgh/UK')
                ->at('8:00');

        // Not Tested
        $schedule->command('DeleteQuestionAnswer')->cron('0 0 */2 * *');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
