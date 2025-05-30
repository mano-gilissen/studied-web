<?php

namespace App\Http\Mail;

use App\Http\Support\Format;
use App\Http\Support\Model;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\UserTrait;
use App\Models\Agreement;
use App\Models\Person;
use App\Models\Study;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class Agreement_Reminder_Management extends Mailable {



    use Queueable, SerializesModels;



    public
        $agreement,
        $employee,
        $student,
        $subject;



    public function __construct($agreement) {

        $this->agreement                    = $agreement;
        $this->employee                     = User::find($agreement->employee);
        $this->student                      = User::find($agreement->student);
        $this->subject                      = 'Vakafspraak ' . $this->agreement->identifier . ' van '
                                            . PersonTrait::getFullName($this->employee->getPerson) . ' heeft na 7 dagen nog geen lessen ingepland';
    }



    public function build() {

        return $this
            ->view('email.agreement_reminder_management', [
                'agreement' => $this->agreement,
                'employee'  => $this->employee,
                'student'   => $this->student])
            ->subject($this->subject);
    }



}
