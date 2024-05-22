<?php



namespace App\Http\Mail;

use App\Http\Support\Model;
use App\Http\Traits\PersonTrait;
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
        $subject;



    public function __construct(Study $study, User $participant) {

        $this->study                                = $study;
        $this->participant                          = $participant;
        $this->subject                              = __('Er is een :service voor je ingepland door :name', ['service' => strtolower($study->getService->{Model::$SERVICE_NAME}), 'name' => PersonTrait::getFullName($study->getHost->getPerson)]);
    }



    public function build() {

        return $this
            ->view('email.study_planned_student')
            ->subject($this->subject);
    }



}
