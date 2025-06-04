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
        $this->subject                              = __('Er is een :service voor je ingepland door :name', ['service' => strtolower($study->getService->{Model::$SERVICE_SHORT}), 'name' => PersonTrait::getFullName($study->getHost->getPerson)]);

        $this->invite                               = Func::generate_calendar_invite(
            'mano.gilissen@gmail.com',
            StudyTrait::getDescription($study),
            StudyTrait::getDescription($study),
            $study->{Model::$STUDY_LOCATION_TEXT},
            $study->{Model::$STUDY_START},
            $study->{Model::$STUDY_END},
            PersonTrait::getFullName($study->getHost->getPerson),
            $study->getHost->{Model::$USER_EMAIL},
            StudyTrait::getParticipants_Email($study)
        );
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
