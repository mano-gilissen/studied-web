<?php



namespace App\Http\Support;

use App\Http\Mail\User_Activate_Customer;
use App\Http\Mail\User_Activate_Employee;
use App\Http\Mail\User_Activate_Student;



class Mail {





    public static function userActivate_forEmployee($user) {

        $mail                                               = new User_Activate_Employee($user);
        $recipient                                          = $user->{Model::$USER_EMAIL};
        $user->{Model::$USER_ACTIVATE_SECRET}               = Func::generate_secret();
        $user->save();

        Mail::to($recipient)->send($mail);
    }



    public static function userActivate_forStudent($user, $study) {

        $mail                                               = new User_Activate_Student($user, $study);
        $recipient                                          = $user->{Model::$USER_EMAIL};
        $user->{Model::$USER_ACTIVATE_SECRET}               = Func::generate_secret();
        $user->save();

        Mail::to($recipient)->send($mail);
    }



    public static function userActivate_forCustomer($user, $study, $student) {

        $mail                                               = new User_Activate_Customer($user, $study, $student);
        $recipient                                          = $user->{Model::$USER_EMAIL};
        $user->{Model::$USER_ACTIVATE_SECRET}               = Func::generate_secret();
        $user->save();

        Mail::to($recipient)->send($mail);
    }





}
