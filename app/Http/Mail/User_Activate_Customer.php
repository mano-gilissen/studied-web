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
use Illuminate\Support\Facades\Lang;



class User_Activate_Customer extends Mailable {



    use Queueable, SerializesModels;



    public

        $user,
        $student,
        $study,
        $subject;



    public function __construct(User $user, Study $study, User $student) {

        $this->user                         = $user;
        $this->student                      = $student;
        $this->study                        = $study;

        $this->subject                      = Lang::get('Proefles voor :name gelukt! Activeer uw account voor onze webapp', ['name' => $student->getPerson->{Model::$PERSON_FIRST_NAME}], $user->{Model::$USER_LANGUAGE});
    }



    public function build() {

        return $this->view('mail.user_activate_customer')->subject($this->subject);

    }



}
