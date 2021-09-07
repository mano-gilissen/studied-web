<?php



namespace App\Http\Mail;

use App\Http\Support\Model;
use App\Http\Traits\StudyTrait;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class User_Activate_Student extends Mailable {



    use Queueable, SerializesModels;



    public

        $user,
        $study,
        $subject;



    public function __construct(User $user, Study $study) {

        $this->user                         = $user;
        $this->study                        = $study;

        $this->subject                      = 'Proefles gelukt! Activeer nu je account voor het Studied webportaal';
    }



    public function build() {

        return $this->view('email.user_activate_student')->subject($this->subject);

    }



}
