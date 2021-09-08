<?php



namespace App\Http\Support;

use App\Http\Mail\Agreement_Approved_Customer;
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

        Mail_::to($recipient)->send($mail);
    }



    public static function userActivate_forStudent($user, $study) {

        $mail                                               = new User_Activate_Student($user, $study);
        $recipient                                          = $user->{Model::$USER_EMAIL};
        $user->{Model::$USER_ACTIVATE_SECRET}               = Func::generate_secret();
        $user->save();

        Mail_::to($recipient)->send($mail);
    }



    public static function userActivate_forCustomer($user, $study, $student) {

        $mail                                               = new User_Activate_Customer($user, $study, $student);
        $recipient                                          = $user->{Model::$USER_EMAIL};
        $user->{Model::$USER_ACTIVATE_SECRET}               = Func::generate_secret();
        $user->save();

        Mail_::to($recipient)->send($mail);
    }



    public static function agreementApproved_forCustomer($user, $study, $student, $agreement) {

        $mail                                               = new Agreement_Approved_Customer($user, $study, $student, $agreement);
        $recipient                                          = $user->{Model::$USER_EMAIL};

        Mail_::to($recipient)->send($mail);
    }



    public static function studyPlanned_forCustomer($study, $participant) {

        $mail                                               = new Study_Planned_Student($study, $participant);
        $recipient                                          = $participant->{Model::$USER_EMAIL};

        Mail_::to($recipient)->send($mail);
    }





}
