<?php

namespace App\Http\Mail;

use App\Http\Support\Func;
use App\Http\Support\Model;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\StudyTrait;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;



class Study_Planned_Student extends Mailable {



    use Queueable, SerializesModels;



    public

        $study,
        $participant,
        $invite,
        $subject;



    public function __construct(Study $study, User $participant) {

        $this->study                                = $study;
        $this->participant                          = $participant;
        $this->subject                              = Lang::get('Er is een :service voor je ingepland door :name', ['service' => strtolower(__($study->getService->{Model::$SERVICE_SHORT})), 'name' => PersonTrait::getFullName($study->getHost->getPerson)], $participant->{Model::$USER_LANGUAGE});
        $this->invite                               = StudyTrait::generateCalendarInvite($study);
    }



    public function build() {

        return $this
            ->view('mail.study_planned_student')
            ->subject($this->subject)
            ->attachData($this->invite, 'invite.ics', [
                'mime' => 'text/calendar; charset=utf-8; method=REQUEST',
            ])
            ->withSwiftMessage(function ($message) {
                $message->addPart($this->invite, 'text/calendar; charset=utf-8; method=REQUEST');
            });
    }



}
