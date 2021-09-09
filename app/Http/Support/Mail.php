<?php



namespace App\Http\Support;

use App\Http\Mail\Agreement_Approved_Customer;
use App\Http\Mail\Agreement_Created_Employee;
use App\Http\Mail\Agreement_Extended_Employee;
use App\Http\Mail\Agreement_Finished_Employee;
use App\Http\Mail\Study_Edited_Employee;
use App\Http\Mail\Study_Edited_Student;
use App\Http\Mail\Study_Planned_Employee;
use App\Http\Mail\Study_Planned_Student;
use App\Http\Mail\User_Activate_Customer;
use App\Http\Mail\User_Activate_Employee;
use App\Http\Mail\User_Activate_Student;
use Illuminate\Support\Facades\Mail as Mail_;



class Mail {





    public static function userActivate_forEmployee($user) {

        $mail                                               = new User_Activate_Employee($user);
        $recipient                                          = $user->{Model::$USER_EMAIL};
        $user->{Model::$USER_ACTIVATE_SECRET}               = Func::generate_secret();
        $user->save();

        self::mailTo($mail, $recipient);
    }



    public static function userActivate_forStudent($user, $study) {

        $mail                                               = new User_Activate_Student($user, $study);
        $recipient                                          = $user->{Model::$USER_EMAIL};
        $user->{Model::$USER_ACTIVATE_SECRET}               = Func::generate_secret();
        $user->save();

        self::mailTo($mail, $recipient);
    }



    public static function userActivate_forCustomer($user, $study, $student) {

        $mail                                               = new User_Activate_Customer($user, $study, $student);
        $recipient                                          = $user->{Model::$USER_EMAIL};
        $user->{Model::$USER_ACTIVATE_SECRET}               = Func::generate_secret();
        $user->save();

        self::mailTo($mail, $recipient);
    }





    public static function agreementApproved_forCustomer($user, $study, $student, $agreement) {

        $mail                                               = new Agreement_Approved_Customer($user, $study, $student, $agreement);
        $recipient                                          = $user->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient);
    }



    public static function agreementFinished_forEmployee($agreement) {

        $employee                                           = $agreement->getEmployee;
        $student                                            = $agreement->getStudent;

        $mail                                               = new Agreement_Finished_Employee($employee, $student, $agreement);
        $recipient                                          = $employee->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient);
    }



    public static function agreementCreated_forEmployee($agreement) {

        $employee                                           = $agreement->getEmployee;
        $student                                            = $agreement->getStudent;

        $mail                                               = new Agreement_Created_Employee($employee, $student, $agreement);
        $recipient                                          = $employee->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient);
    }



    public static function agreementExtended_forEmployee($agreement) {

        $employee                                           = $agreement->getEmployee;
        $student                                            = $agreement->getStudent;

        $mail                                               = new Agreement_Extended_Employee($employee, $student, $agreement);
        $recipient                                          = $employee->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient);
    }





    public static function studyPlanned_forStudent($study, $participant) {

        $mail                                               = new Study_Planned_Student($study, $participant);
        $recipient                                          = $participant->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient);
    }



    public static function studyPlanned_forEmployee($study) {

        $mail                                               = new Study_Planned_Employee($study);
        $recipient                                          = $study->getHost->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient);
    }





    public static function studyEdited_forStudent($study, $participant) {

        $mail                                               = new Study_Edited_Student($study, $participant);
        $recipient                                          = $participant->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient);
    }



    public static function studyEdited_forEmployee($study) {

        $mail                                               = new Study_Edited_Employee($study);
        $recipient                                          = $study->getHost->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient);
    }





    public static function mailTo($mail, $recipient) {

        try {

            Mail_::to($recipient)->send($mail);

        } catch(Exception $e) {

            echo($recipient);

        }
    }





}
