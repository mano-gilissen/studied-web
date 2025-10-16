<?php



namespace App\Http\Support;

use App\Http\Mail\Agreement_Approved_Customer;
use App\Http\Mail\Agreement_Created_Employee;
use App\Http\Mail\Agreement_Extended_Employee;
use App\Http\Mail\Agreement_Finished_Employee;
use App\Http\Mail\Agreement_Reminder_Management;
use App\Http\Mail\Announcement_Created;
use App\Http\Mail\Evaluation_Created_Customer;
use App\Http\Mail\Evaluation_Created_Employee;
use App\Http\Mail\Evaluation_Created_Host;
use App\Http\Mail\Evaluation_Created_Student;
use App\Http\Mail\Evaluation_Edited_Customer;
use App\Http\Mail\Evaluation_Edited_Employee;
use App\Http\Mail\Evaluation_Edited_Host;
use App\Http\Mail\Evaluation_Edited_Student;
use App\Http\Mail\Report_Weekly_Management;
use App\Http\Mail\Todos_Weekly_Employee;
use App\Http\Mail\Student_Linked_Customer;
use App\Http\Mail\Study_Edited_Employee;
use App\Http\Mail\Study_Edited_Student;
use App\Http\Mail\Study_Planned_Employee;
use App\Http\Mail\Study_Planned_Student;
use App\Http\Mail\User_Activate_Customer;
use App\Http\Mail\User_Activate_Customer_NoStudy;
use App\Http\Mail\User_Activate_Employee;
use App\Http\Mail\User_Activate_Relations;
use App\Http\Mail\User_Activate_Reminder;
use App\Http\Mail\User_Activate_Student;
use App\Http\Mail\User_Activate_Student_NoStudy;
use App\Http\Middleware\Locale;
use App\Models\User;
use Illuminate\Support\Facades\Mail as Mail_;



class Mail {





    public static function userActivate($user, $mail) {

        $recipient                                          = $user->{Model::$USER_EMAIL};

        $user->{Model::$USER_ACTIVATE_SECRET}               = $user->{Model::$USER_ACTIVATE_SECRET} ?? Func::generate_secret();
        $user->{Model::$USER_ACTIVATE_SENT}                 = date('Y-m-d H:i:s');
        $user->save();

        self::mailTo($mail, $recipient, $user->{Model::$USER_LANGUAGE});
    }

    public static function userActivate_forEmployee($user) {

        self::userActivate($user, new User_Activate_Employee($user));

    }

    public static function userActivate_forStudent($user, $study) {

        self::userActivate($user, new User_Activate_Student($user, $study));

    }

    public static function userActivate_forCustomer($user, $study, $student) {

        self::userActivate($user, new User_Activate_Customer($user, $study, $student));

    }

    public static function userActivate_forStudent_noStudy($user) {

        self::userActivate($user, new User_Activate_Student_NoStudy($user));

    }

    public static function userActivate_forCustomer_noStudy($user) {

        self::userActivate($user, new User_Activate_Customer_NoStudy($user));

    }

    public static function userActivate_reminder($user) {

        self::mailTo(new User_Activate_Reminder($user), $user->{Model::$USER_EMAIL});

    }



    public static function userActivate_forRelations($student, $relation_name, $relation_email) {

        $mail                                               = new User_Activate_Relations($student, $relation_name, $relation_email);
        $recipient                                          = $relation_email;

        self::mailTo($mail, $recipient);
    }



    public static function agreementApproved_forCustomer($user, $study, $student, $agreement) {

        $mail                                               = new Agreement_Approved_Customer($user, $study, $student, $agreement);
        $recipient                                          = $user->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $user->{Model::$USER_LANGUAGE});
    }



    public static function agreementReminder_forManagement($agreement) {

        $mail                                               = new Agreement_Reminder_Management($agreement);
        $recipients                                         = ['mano.gilissen@gmail.com', 'b.jennissen@studied.nl', 'sales@studied.nl'];

        self::mailTo($mail, $recipients);
    }



    public static function agreementFinished_forEmployee($agreement) {

        $employee                                           = $agreement->getEmployee;
        $student                                            = $agreement->getStudent;

        $mail                                               = new Agreement_Finished_Employee($employee, $student, $agreement);
        $recipient                                          = $employee->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $employee->{Model::$USER_LANGUAGE});
    }



    public static function agreementCreated_forEmployee($agreement) {

        $employee                                           = $agreement->getEmployee;
        $student                                            = $agreement->getStudent;

        $mail                                               = new Agreement_Created_Employee($employee, $student, $agreement);
        $recipient                                          = $employee->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $employee->{Model::$USER_LANGUAGE});
    }



    public static function agreementExtended_forEmployee($agreement) {

        $employee                                           = $agreement->getEmployee;
        $student                                            = $agreement->getStudent;

        $mail                                               = new Agreement_Extended_Employee($employee, $student, $agreement);
        $recipient                                          = $employee->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $employee->{Model::$USER_LANGUAGE});
    }





    public static function studyPlanned_forStudent($study, $participant) {

        $mail                                               = new Study_Planned_Student($study, $participant);
        $recipient                                          = $participant->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $participant->{Model::$USER_LANGUAGE});
    }



    public static function studyPlanned_forEmployee($study) {

        $mail                                               = new Study_Planned_Employee($study);
        $recipient                                          = $study->getHost->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $study->getHost->{Model::$USER_LANGUAGE});
    }





    public static function studyEdited_forStudent($study, $participant) {

        $mail                                               = new Study_Edited_Student($study, $participant);
        $recipient                                          = $participant->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $participant->{Model::$USER_LANGUAGE});
    }



    public static function studyEdited_forEmployee($study) {

        $mail                                               = new Study_Edited_Employee($study);
        $recipient                                          = $study->getHost->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $study->getHost->{Model::$USER_LANGUAGE});
    }





    public static function evaluationCreated_forHost($employee, $evaluation) {

        $mail                                               = new Evaluation_Created_Host($employee, $evaluation);
        $recipient                                          = $employee->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $employee->{Model::$USER_LANGUAGE});
    }



    public static function evaluationCreated_forEmployee($employee, $evaluation) {

        $mail                                               = new Evaluation_Created_Employee($employee, $evaluation);
        $recipient                                          = $employee->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $employee->{Model::$USER_LANGUAGE});
    }



    public static function evaluationCreated_forStudent($student, $evaluation) {

        $mail                                               = new Evaluation_Created_Student($student, $evaluation);
        $recipient                                          = $student->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $student->{Model::$USER_LANGUAGE});
    }



    public static function evaluationCreated_forCustomer($customer, $evaluation) {

        $mail                                               = new Evaluation_Created_Customer($customer, $evaluation);
        $recipient                                          = $customer->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $customer->{Model::$USER_LANGUAGE});
    }





    public static function evaluationEdited_forHost($employee, $evaluation) {

        $mail                                               = new Evaluation_Edited_Host($employee, $evaluation);
        $recipient                                          = $employee->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $employee->{Model::$USER_LANGUAGE});
    }



    public static function evaluationEdited_forEmployee($employee, $evaluation) {

        $mail                                               = new Evaluation_Edited_Employee($employee, $evaluation);
        $recipient                                          = $employee->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $employee->{Model::$USER_LANGUAGE});
    }



    public static function evaluationEdited_forStudent($student, $evaluation) {

        $mail                                               = new Evaluation_Edited_Student($student, $evaluation);
        $recipient                                          = $student->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $student->{Model::$USER_LANGUAGE});
    }



    public static function evaluationEdited_forCustomer($customer, $evaluation) {

        $mail                                               = new Evaluation_Edited_Customer($customer, $evaluation);
        $recipient                                          = $customer->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $customer->{Model::$USER_LANGUAGE});
    }





    public static function announcementCreated($user) {

        $mail                                               = new Announcement_Created($user);
        $recipient                                          = $user->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $user->{Model::$USER_LANGUAGE});
    }





    public static function studentLinked_forCustomer($student, $customer) {

        $mail                                               = new Student_Linked_Customer($student, $customer);
        $recipient                                          = $customer->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $customer->{Model::$USER_LANGUAGE});
    }





    public static function reportWeekly($list_deficit, $list_unreported, $list_flagged) {

        $mail                                               = new Report_Weekly_Management($list_deficit, $list_unreported, $list_flagged);
        $recipients                                         = ['mano.gilissen@gmail.com', 'b.jennissen@studied.nl', 'sales@studied.nl'];

        self::mailTo($mail, $recipients);
    }



    public static function todosWeekly($todos, $user) {

        $mail                                               = new Todos_Weekly_Employee($todos, $user);
        $recipient                                          = $user->{Model::$USER_EMAIL};

        self::mailTo($mail, $recipient, $user->{Model::$USER_LANGUAGE});
    }





    public static function mailTo($mail, $recipient, $locale = Locale::LOCALE_NL) {

        try {

            Mail_::to($recipient)
                ->locale($locale)
                ->send($mail);

        } catch(Exception $e) {

            echo($recipient);

        }
    }





}
