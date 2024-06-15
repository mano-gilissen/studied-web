<?php

namespace App\Console;

use App\Http\Controllers\UserController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {



    protected $commands = [];



    protected function schedule(Schedule $schedule) {

        $schedule
            ->call(function() {

                try {

                    UserController::scheduled_activation_reminder();

                } catch (Exception $e) {

                    $this->info($e->getMessage());

                }
            })
            ->hourly()
            ->emailOutputOnFailure('mano.gilissen@gmail.com');
    }



    protected function commands() {

        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }



}
