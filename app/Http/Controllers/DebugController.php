<?php



namespace App\Http\Controllers;

use App\Http\Mail\Study_Planned_Student;
use App\Http\Support\Func;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\StudyTrait;
use App\Models\Study;
use App\Models\Subject;
use App\Models\Person;
use App\Http\Support\Key;
use App\Http\Support\Views;
use App\Http\Support\Format;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Support\Model;
use Auth;



class DebugController extends Controller {





    public function export_csv_test($header) {

        $rows                   = [['a','b','c'],[1,2,3]];
        $columnNames            = [$header, 'yada', 'hmm'];

        return Func::export_csv($columnNames, $rows);
    }



    public function activate_reminder_test() {

        UserController::scheduled_activation_reminder();

    }



    public function report_weekly_test() {

        StudyTrait::scheduled_report_weekly();

    }



    public function agreement_reminder_plan_test() {

        AgreementTrait::plan_reminders_losse_lessen();

    }





}
