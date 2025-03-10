<?php

namespace App\Console\Commands;

use App\Http\Controllers\StudyController;
use App\Http\Controllers\UserController;
use Illuminate\Console\Command;



class ReportWeekly extends Command {



    protected $signature                = 'report:weekly';
    protected $description              = 'Sends a weekly report to management listing study scheduling and reporting issues.';



    public function __construct() {

        parent::__construct();

    }



    public function handle() {

        $result = StudyController::scheduled_report_weekly();

        if ($result) {

            \Log::info('Weekly report has been sent to management.');

            $this->info('Weekly report has been sent to management.');
        }
    }



}
