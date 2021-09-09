<?php



namespace App\Http\Traits;

use App\Http\Support\Key;
use App\Http\Support\Mail;
use App\Http\Support\Model;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;



trait StudentTrait {





    public static function create(array $data) {

        self::validate($data);

        $student                                                            = new Student;
        $user                                                               = UserTrait::create($data, RoleTrait::$ID_STUDENT);

        if (!$user) {

            return false;

        }

        $student->{Model::$USER}                                            = $user->{Model::$BASE_ID};
        $student->{Model::$CUSTOMER}                                        = $data[Key::AUTOCOMPLETE_ID . Model::$CUSTOMER];

        $student->{Model::$STUDENT_SCHOOL}                                  = $data[Model::$STUDENT_SCHOOL];
        $student->{Model::$STUDENT_PROFILE}                                 = $data[Model::$STUDENT_PROFILE];
        $student->{Model::$STUDENT_NIVEAU}                                  = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT_NIVEAU];
        $student->{Model::$STUDENT_LEERJAAR}                                = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT_LEERJAAR];



        // TODO: REPLACE WITH RELATIONS SYSTEM

        $student->{Model::$STUDENT_NAME_MENTOR}                             = $data[Model::$STUDENT_NAME_MENTOR];
        $student->{Model::$STUDENT_NAME_VAKDOCENT_1}                        = $data[Model::$STUDENT_NAME_VAKDOCENT_1];
        $student->{Model::$STUDENT_NAME_VAKDOCENT_2}                        = $data[Model::$STUDENT_NAME_VAKDOCENT_2];
        $student->{Model::$STUDENT_NAME_VAKDOCENT_3}                        = $data[Model::$STUDENT_NAME_VAKDOCENT_3];
        $student->{Model::$STUDENT_EMAIL_MENTOR}                            = $data[Model::$STUDENT_EMAIL_MENTOR];
        $student->{Model::$STUDENT_EMAIL_VAKDOCENT_1}                       = $data[Model::$STUDENT_EMAIL_VAKDOCENT_1];
        $student->{Model::$STUDENT_EMAIL_VAKDOCENT_2}                       = $data[Model::$STUDENT_EMAIL_VAKDOCENT_2];
        $student->{Model::$STUDENT_EMAIL_VAKDOCENT_3}                       = $data[Model::$STUDENT_EMAIL_VAKDOCENT_3];



        $student->save();



        if (self::hasCustomer($student)) {

            $user_customer                                                  = $student->getCustomer->getUser;

            if (UserTrait::isActivated($user_customer) && $student->getCustomer->getStudents->count() > 1) {

                Mail::studentLinked_forCustomer($student->getUser, $user_customer);

            }
        }



        return $student;
    }



    public static function update(array $data, $student) {

        self::validate($data);

        $customerBefore                                                     = self::hasCustomer($student) ? $student->{Model::$CUSTOMER} : null;

        $student->{Model::$CUSTOMER}                                        = $data[Key::AUTOCOMPLETE_ID . Model::$CUSTOMER];

        $student->{Model::$STUDENT_SCHOOL}                                  = $data[Model::$STUDENT_SCHOOL];
        $student->{Model::$STUDENT_PROFILE}                                 = $data[Model::$STUDENT_PROFILE];
        $student->{Model::$STUDENT_NIVEAU}                                  = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT_NIVEAU];
        $student->{Model::$STUDENT_LEERJAAR}                                = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT_LEERJAAR];



        // TODO: REPLACE WITH RELATIONS SYSTEM

        $student->{Model::$STUDENT_NAME_MENTOR}                             = $data[Model::$STUDENT_NAME_MENTOR];
        $student->{Model::$STUDENT_NAME_VAKDOCENT_1}                        = $data[Model::$STUDENT_NAME_VAKDOCENT_1];
        $student->{Model::$STUDENT_NAME_VAKDOCENT_2}                        = $data[Model::$STUDENT_NAME_VAKDOCENT_2];
        $student->{Model::$STUDENT_NAME_VAKDOCENT_3}                        = $data[Model::$STUDENT_NAME_VAKDOCENT_3];
        $student->{Model::$STUDENT_EMAIL_MENTOR}                            = $data[Model::$STUDENT_EMAIL_MENTOR];
        $student->{Model::$STUDENT_EMAIL_VAKDOCENT_1}                       = $data[Model::$STUDENT_EMAIL_VAKDOCENT_1];
        $student->{Model::$STUDENT_EMAIL_VAKDOCENT_2}                       = $data[Model::$STUDENT_EMAIL_VAKDOCENT_2];
        $student->{Model::$STUDENT_EMAIL_VAKDOCENT_3}                       = $data[Model::$STUDENT_EMAIL_VAKDOCENT_3];



        $student->save();



        if (self::hasCustomer($student) && (!$customerBefore || $customerBefore != $student->{Model::$CUSTOMER})) {

            $user_customer                                                  = $student->getCustomer->getUser;

            if (UserTrait::isActivated($user_customer) && $student->getCustomer->getStudents->count() > 1) {

                Mail::studentLinked_forCustomer($student->getUser, $user_customer);

            }
        }



        return $student;
    }



    public static function validate(array $data) {

        $rules                                                              = [];

        $rules[Model::$STUDENT_SCHOOL]                                      = ['required'];
        $rules[Model::$STUDENT_NIVEAU]                                      = ['required'];
        $rules[Model::$STUDENT_LEERJAAR]                                    = ['required'];

        $validator                                                          = Validator::make($data, $rules, BaseTrait::getValidationMessages());

        $validator->validate();
    }



    public static function notifyRelations_ofActivation($user) {

        // TODO: REPLACE WITH RELATION SYSTEM

        $student = $user->getStudent;

        if ($student->{Model::$STUDENT_NAME_MENTOR} != null && $student->{Model::$STUDENT_EMAIL_MENTOR} != null) {

            Mail::userActivate_forRelations($user, $student->{Model::$STUDENT_NAME_MENTOR}, $student->{Model::$STUDENT_EMAIL_MENTOR});                Mail::userActivate_forRelations($user, $student->{Model::$STUDENT_NAME_MENTOR}, $student->{Model::$STUDENT_EMAIL_MENTOR});

        }

        if ($student->{Model::$STUDENT_NAME_VAKDOCENT_1} != null && $student->{Model::$STUDENT_EMAIL_VAKDOCENT_1} != null) {

            Mail::userActivate_forRelations($user, $student->{Model::$STUDENT_NAME_VAKDOCENT_1}, $student->{Model::$STUDENT_EMAIL_VAKDOCENT_1});                Mail::userActivate_forRelations($user, $student->{Model::$STUDENT_NAME_MENTOR}, $student->{Model::$STUDENT_EMAIL_MENTOR});

        }

        if ($student->{Model::$STUDENT_NAME_VAKDOCENT_2} != null && $student->{Model::$STUDENT_EMAIL_VAKDOCENT_2} != null) {

            Mail::userActivate_forRelations($user, $student->{Model::$STUDENT_NAME_VAKDOCENT_2}, $student->{Model::$STUDENT_EMAIL_VAKDOCENT_2});                Mail::userActivate_forRelations($user, $student->{Model::$STUDENT_NAME_MENTOR}, $student->{Model::$STUDENT_EMAIL_MENTOR});

        }

        if ($student->{Model::$STUDENT_NAME_VAKDOCENT_3} != null && $student->{Model::$STUDENT_EMAIL_VAKDOCENT_3} != null) {

            Mail::userActivate_forRelations($user, $student->{Model::$STUDENT_NAME_VAKDOCENT_3}, $student->{Model::$STUDENT_EMAIL_VAKDOCENT_3});                Mail::userActivate_forRelations($user, $student->{Model::$STUDENT_NAME_MENTOR}, $student->{Model::$STUDENT_EMAIL_MENTOR});

        }
    }






    public static function hasCustomer($student) {

        return $student->getCustomer != null;

    }



    public static function getSchoolData() {

        return [
            'Porta Mosana College',
            'Sint-Maartens College',
            'Stella Maris College'
        ];
    }



    public static function getNiveauText($status) {

        switch ($status) {

            case 1:                                         return "Vmbo-bb";
            case 2:                                         return "Vmbo-kb";
            case 3:                                         return "Vmbo-gl";
            case 4:                                         return "Vmbo-tl";
            case 5:                                         return "Tl-Havo";
            case 6:                                         return "Havo";
            case 7:                                         return "Havo/vwo";
            case 8:                                         return "Vwo";
            case 9:                                         return "Gymnasium";
            case 10:                                        return "TTO havo";
            case 11:                                        return "TTO vwo";
            case 12:                                        return "TTO gymnasium";
            default:                                        return Key::UNKNOWN;
        }
    }



    public static function getNiveauData() {

        return [
            1                                               => self::getNiveauText(1),
            2                                               => self::getNiveauText(2),
            3                                               => self::getNiveauText(3),
            4                                               => self::getNiveauText(4),
            5                                               => self::getNiveauText(5),
            6                                               => self::getNiveauText(6),
            7                                               => self::getNiveauText(7),
            8                                               => self::getNiveauText(8),
            9                                               => self::getNiveauText(9),
            10                                              => self::getNiveauText(10),
            11                                              => self::getNiveauText(11),
            12                                              => self::getNiveauText(12)
        ];
    }



    public static function getLeerjaarData() {

        return [
            1                                               => 1,
            2                                               => 2,
            3                                               => 3,
            4                                               => 4,
            5                                               => 5,
            6                                               => 6
        ];
    }



    public static function getProfileData() {

        return [
            'CM',
            'EM',
            'NG',
            'NT',
            'CM & EM',
            'NG & NT',
            'Overige profielcombinatie',
            'BWI',
            'DP',
            'EO',
            'G',
            'HBR',
            'MTE',
            'MVI',
            'MTR',
            'PIE',
            'VRTE',
            'ZWE'
        ];
    }





}
