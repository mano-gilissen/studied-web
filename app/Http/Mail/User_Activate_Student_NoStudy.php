<?php



namespace App\Http\Mail;

use App\Http\Support\Model;
use App\Http\Traits\StudyTrait;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class User_Activate_Student_NoStudy extends Mailable {



    use Queueable, SerializesModels;



    public

        $user,
        $subject;



    public function __construct(User $user) {

        $this->user                         = $user;

        $this->subject                      = 'Activeer je account voor onze webapp';
    }



    public function build() {

        return $this->view('email.user_activate_student_nostudy')->subject($this->subject);

    }



}
