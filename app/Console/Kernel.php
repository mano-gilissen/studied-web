<?php

namespace App\Console;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Traits\AgreementTrait;
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
            ->call(function() { StudyTrait::scheduled_report_weekly(); })
            ->weeklyOn(1, '0:01')
            ->emailOutputOnFailure('mano.gilissen@gmail.com');

        $schedule
            ->call(function() { AgreementTrait::plan_reminders_losse_lessen(); })
            ->dailyAt(1, '12:00')
            ->emailOutputOnFailure('mano.gilissen@gmail.com');

        $schedule
            ->call(function() { DashboardController::announcement_send_emails(); })
            ->everyFiveMinutes()
            ->emailOutputOnFailure('mano.gilissen@gmail.com');
    }



    protected function commands() {

        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }



}
