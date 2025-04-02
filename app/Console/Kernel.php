<?php

namespace App\Console;

use App\Http\Controllers\UserController;
use App\Http\Traits\StudyTrait;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {



    protected $commands = [];



    protected function schedule(Schedule $schedule) {

        $schedule
            ->command('activate:reminder')
            ->hourly()
            ->emailOutputOnFailure('mano.gilissen@gmail.com');

        $schedule
            ->call(function() {

                if (StudyTrait::scheduled_report_weekly()) {

                    \Log::info('Weekly report has been sent to management.');

                }
            })
            ->weeklyOn(1, '0:01')
            ->emailOutputOnFailure('mano.gilissen@gmail.com');
    }



    protected function commands() {

        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }



}
