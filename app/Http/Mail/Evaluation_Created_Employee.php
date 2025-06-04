<?php



namespace App\Http\Mail;

use App\Http\Support\Func;
use App\Http\Support\Model;
use App\Http\Traits\EvaluationTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\StudyTrait;
use App\Models\Agreement;
use App\Models\Evaluation;
use App\Models\Person;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use DateTime;



class Evaluation_Created_Employee extends Mailable {



    use Queueable, SerializesModels;



    public

        $employee,
        $evaluation,
        $subject;



    public function __construct(User $employee, Evaluation $evaluation) {

        $this->employee                     = $employee;
        $this->evaluation                   = $evaluation;

        $this->subject                      = __('Er is een :regarding met jou als deelnemer ingepland.', ['regarding' => strtolower(EvaluationTrait::getRegardingText($evaluation->{Model::$EVALUATION_REGARDING}))]);

        $this->invite                       = Func::generate_calendar_invite(
            'evaluation-' . $evaluation->{Model::$BASE_KEY} . '@studied.app',
            EvaluationTrait::getDescription($evaluation),
            EvaluationTrait::getDescription($evaluation),
            $evaluation->{Model::$EVALUATION_LOCATION_TEXT},
            $evaluation->{Model::$EVALUATION_DATETIME},
            (new DateTime($evaluation->{Model::$EVALUATION_DATETIME}))->modify('+1 hour')->format('Y-m-d H:i:s'),
            PersonTrait::getFullName($evaluation->getHost->getPerson),
            $evaluation->getHost->{Model::$USER_EMAIL},
            ['name' => PersonTrait::getFullName($employee), 'email' => $employee->{Model::$USER_EMAIL}]
        );
    }



    public function build() {

        return $this->view('mail.evaluation_created_employee')->subject($this->subject);

    }



}
