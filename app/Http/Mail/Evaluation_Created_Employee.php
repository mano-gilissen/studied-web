<?php



namespace App\Http\Mail;

use App\Http\Support\Model;
use App\Http\Traits\EvaluationTrait;
use App\Http\Traits\StudyTrait;
use App\Models\Agreement;
use App\Models\Evaluation;
use App\Models\Person;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class Evaluation_Created_Employee extends Mailable {



    use Queueable, SerializesModels;



    public

        $employee,
        $evaluation,
        $subject;



    public function __construct(User $employee, Evaluation $evaluation) {

        $this->employee                     = $employee;
        $this->evaluation                   = $evaluation;

        $this->subject                      = 'Er is een ' . strtolower(EvaluationTrait::getRegardingText($evaluation)) . ' met jou als deelnemer ingepland.';
    }



    public function build() {

        return $this->view('email.evaluation_created_employee')->subject($this->subject);

    }



}
