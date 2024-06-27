<?php

namespace App\Console\Commands;

use App\Http\Controllers\UserController;
use Illuminate\Console\Command;



class ActivateReminder extends Command {



    protected $signature                = 'activate:reminder';
    protected $description              = 'Sends activation reminders to users who have not activated their account yet.';



    public function __construct() {

        parent::__construct();

    }



    public function handle() {

        $result = UserController::scheduled_activation_reminder();

        if ($result) {

            \Log::info('Activation reminders have been sent to ' . $result);

            $this->info('Activation reminders have been sent to ' . $result);
        }
    }



}
