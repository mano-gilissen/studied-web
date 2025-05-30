<?php



namespace App\Http\Mail;

use App\Http\Support\Model;
use App\Http\Traits\StudyTrait;
use App\Models\Agreement;
use App\Models\Person;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class Agreement_Approved_Customer extends Mailable {



    use Queueable, SerializesModels;



    public

        $user,

        $student,
        $study,
        $agreement,
        $subject;



    public function __construct(User $user, Study $study, User $student, Agreement $agreement) {

        $this->user                         = $user;
        $this->student                      = $student;
        $this->study                        = $study;
        $this->agreement                    = $agreement;

        $this->subject                      = __('De proefles :subject voor :name was een succes!', ['subject' => StudyTrait::getSubject($study)->{Model::$SUBJECT_NAME}, 'name' => $student->getPerson->{Model::$PERSON_FIRST_NAME}]);
    }



    public function build() {

        return $this->view('mail.agreement_approved_customer')->subject($this->subject);

    }



}
