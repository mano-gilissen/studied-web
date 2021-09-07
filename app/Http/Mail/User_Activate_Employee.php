<?php



namespace App\Http\Mail;

use App\Http\Support\Model;
use App\Http\Traits\StudyTrait;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class User_Activate_Employee extends Mailable {



    use Queueable, SerializesModels;



    public

        $user,
        $subject;



    public function __construct(User $user) {

        $this->user                         = $user;
        $this->subject                      = 'Activeer nu je account voor het Studied webportaal.';
    }



    public function build() {

        return $this->view('email.user_activate_employee')->subject($this->subject);

    }



}
