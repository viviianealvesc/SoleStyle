<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Adicione seus comandos personalizados aqui
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('cupom:expire')->daily();
    }


}
