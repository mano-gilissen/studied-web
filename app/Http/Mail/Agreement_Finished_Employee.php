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
use Illuminate\Support\Facades\Lang;



class Agreement_Finished_Employee extends Mailable {



    use Queueable, SerializesModels;



    public

        $employee,
        $student,
        $agreement,
        $subject;



    public function __construct(User $employee, User $student, Agreement $agreement) {

        $this->employee                     = $employee;
        $this->student                      = $student;
        $this->agreement                    = $agreement;

        $this->subject                      = Lang::get('Je vakafspraak :subject met :name is afgehandeld.', ['subject' => $agreement->getSubject->{Model::$SUBJECT_NAME}, 'name' => $student->getPerson->{Model::$PERSON_FIRST_NAME}], $employee->{Model::$USER_LANGUAGE});
    }



    public function build() {

        return $this->view('mail.agreement_finished_employee')->subject($this->subject);

    }



}
