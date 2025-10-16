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
use Illuminate\Support\Facades\Lang;
use DateTime;



class Evaluation_Edited_Customer extends Mailable {



    use Queueable, SerializesModels;



    public

        $customer,
        $evaluation,
        $invite,
        $subject;



    public function __construct(User $customer, Evaluation $evaluation) {

        $this->customer                     = $customer;
        $this->evaluation                   = $evaluation;
        $this->subject                      = Lang::get('Het tijdstip of de datum van uw :regarding met :name is gewijzigd.', [
            'regarding' => strtolower(EvaluationTrait::getRegardingText($evaluation->{Model::$EVALUATION_REGARDING})),
            'name' => $evaluation->getEmployee->getPerson->first_name
        ], $customer->{Model::$USER_LANGUAGE});
        $this->invite                       = EvaluationTrait::generateCalendarInvite($evaluation);
    }



    public function build() {

        return $this
            ->view('mail.evaluation_edited_customer')
            ->subject($this->subject)
            ->attachData($this->invite, 'invite.ics', [
                'mime' => 'text/calendar; charset=utf-8; method=REQUEST',
            ])
            ->withSwiftMessage(function ($message) {
                $message->addPart($this->invite, 'text/calendar; charset=utf-8; method=REQUEST');
            });
    }



}
