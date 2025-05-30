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



class Evaluation_Created_Student extends Mailable {



    use Queueable, SerializesModels;



    public

        $student,
        $evaluation,
        $subject;



    public function __construct(User $student, Evaluation $evaluation) {

        $this->student                      = $student;
        $this->evaluation                   = $evaluation;

        $this->subject                      = __('Er is een :regarding met je ingepland!', ['regarding' => strtolower(EvaluationTrait::getRegardingText($evaluation->{Model::$EVALUATION_REGARDING}))]);
    }



    public function build() {

        return $this->view('mail.evaluation_created_student')->subject($this->subject);

    }



}
