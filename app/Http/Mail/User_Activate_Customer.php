<?php



namespace App\Http\Mail;

use App\Http\Support\Model;
use App\Http\Traits\StudyTrait;
use App\Models\Person;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class User_Activate_Customer extends Mailable {



    use Queueable, SerializesModels;



    public

        $user,
        $student,
        $study,
        $subject;



    public function __construct(User $user, Study $study, Person $student) {

        $this->user                         = $user;
        $this->student                      = $student;
        $this->study                        = $study;

        $this->subject                      = 'Proefles voor ' . $student->{Model::$PERSON_FIRST_NAME} . ' gelukt! Activeer nu uw account voor het Studied webportaal';
    }



    public function build() {

        return $this->view('email.user_activate_customer')->subject($this->subject);

    }



}
