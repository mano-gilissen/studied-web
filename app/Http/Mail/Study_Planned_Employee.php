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



class Study_Planned_Employee extends Mailable {



    use Queueable, SerializesModels;



    public

        $study,
        $employee,
        $subject;



    public function __construct(Study $study) {

        $this->study                                = $study;
        $this->employee                             = $study->getHost;
        $this->subject                              = __('Er is een :service voor je ingepland met :participants', ['service' => strtolower($study->getService->{Model::$SERVICE_NAME}), 'participants' => StudyTrait::getParticipantsText($study)]);
    }



    public function build() {

        return $this
            ->view('mail.study_planned_employee')
            ->subject($this->subject);
    }



}
