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



class Study_Edited_Student extends Mailable {



    use Queueable, SerializesModels;



    public

        $study,
        $participant,
        $subject;



    public function __construct(Study $study, User $participant) {

        $this->study                                = $study;
        $this->participant                          = $participant;
        $this->subject                              = __('De gegevens van je les :subject met :name zijn gewijzigd.', ['subject' => strtolower(StudyTrait::getSubject($study)->{Model::$SUBJECT_NAME}), 'name' => PersonTrait::getFullName($participant->getPerson)]);
    }



    public function build() {

        return $this
            ->view('mail.study_edited_student')
            ->subject($this->subject);
    }



}
