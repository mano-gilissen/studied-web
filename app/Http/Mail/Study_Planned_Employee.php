<?php



namespace App\Http\Mail;

use App\Http\Traits\PersonTrait;
use App\Http\Traits\StudyTrait;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class Study_Planned_Employee extends Mailable {



    use Queueable, SerializesModels;



    public

        $study,
        $employee,
        $subject;



    const

        MAIL_SUBJECT                                = 'Er is een les voor jou ingepland met ';



    public function __construct(Study $study) {

        $this->study                                = $study;
        $this->employee                             = $study->getHost;
        $this->subject                              = self::MAIL_SUBJECT . StudyTrait::getParticipantsText($study);
    }



    public function build() {

        return $this
            ->view('email.study_planned_employee')
            ->subject($this->subject);
    }



}
