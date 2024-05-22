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



class User_Activate_Relations extends Mailable {



    use Queueable, SerializesModels;



    public

        $student,
        $relation_name,
        $relation_email,
        $subject;



    public function __construct(User $student, $relation_name, $relation_email) {

        $this->student                      = $student;
        $this->relation_name                = $relation_name;
        $this->relation_email               = $relation_email;

        $this->subject                      = __(':name heeft nu begeleiding van ons!', ['name' => $student->getPerson->{Model::$PERSON_FIRST_NAME}]);
    }



    public function build() {

        return $this->view('email.user_activate_relations')->subject($this->subject);

    }



}
