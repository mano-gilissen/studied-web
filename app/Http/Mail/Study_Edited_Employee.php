<?php



namespace App\Http\Mail;

use App\Http\Support\Model;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\StudyTrait;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class Study_Edited_Employee extends Mailable {



    use Queueable, SerializesModels;



    public

        $study,
        $employee,
        $subject;



    public function __construct(Study $study) {

        $this->study                                = $study;
        $this->employee                             = $study->getHost;
        $this->subject                              = 'De gegevens van je les ' . strtolower(StudyTrait::getSubject($study)->{Model::$SUBJECT_NAME}) . ' met ' . StudyTrait::getParticipantsText($study) . ' zijn gewijzigd.';
    }



    public function build() {

        return $this
            ->view('email.study_edited_employee')
            ->subject($this->subject);
    }



}
