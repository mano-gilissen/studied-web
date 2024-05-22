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



class Evaluation_Created_Customer extends Mailable {



    use Queueable, SerializesModels;



    public

        $customer,
        $evaluation,
        $subject;



    public function __construct(User $customer, Evaluation $evaluation) {

        $this->customer                     = $customer;
        $this->evaluation                   = $evaluation;

        $this->subject                      = __('Er is een :regarding met u ingepland.', ['regarding' => strtolower(EvaluationTrait::getRegardingText($evaluation->{Model::$EVALUATION_REGARDING}))]);
    }



    public function build() {

        return $this->view('email.evaluation_created_customer')->subject($this->subject);

    }



}
