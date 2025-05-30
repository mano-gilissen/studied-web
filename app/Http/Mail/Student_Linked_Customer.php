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



class Student_Linked_Customer extends Mailable {



    use Queueable, SerializesModels;



    public

        $student,
        $customer,
        $subject;



    public function __construct(User $student, User $customer) {

        $this->student                      = $student;
        $this->customer                     = $customer;

        $this->subject                      = __(':name is als leerling bij u toegevoegd!', ['name' => $student->getPerson->{Model::$PERSON_FIRST_NAME}]);
    }



    public function build() {

        return $this->view('mail.student_linked_customer')->subject($this->subject);

    }



}
