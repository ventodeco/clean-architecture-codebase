<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [];
    
    /**
     * schedule
     *
     * @param  mixed $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {}
    
    /**
     * commands
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
