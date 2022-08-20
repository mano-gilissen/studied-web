<?php



namespace App\Http\Traits;

use App\Http\Support\Key;
use App\Http\Support\Mail;
use App\Http\Support\Model;
use App\Models\Customer;
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

        $student->{Model::$STUDENT_MIN}                                     = $data[Model::$STUDENT_MIN];
        $student->{Model::$STUDENT_MAX}                                     = $data[Model::$STUDENT_MAX];



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



        if ($student->{Model::$CUSTOMER} > 0) {

            $customer                                                   = Customer::find($student->{Model::$CUSTOMER});
            $user_customer                                              = $customer->getUser;

            if (UserTrait::isActivated($user_customer) && $customer->getStudents->count() > 1) {

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

        $student->{Model::$STUDENT_MIN}                                     = $data[Model::$STUDENT_MIN];
        $student->{Model::$STUDENT_MAX}                                     = $data[Model::$STUDENT_MAX];



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



        if (($student->{Model::$CUSTOMER} > 0) && (!$customerBefore || $customerBefore != $student->{Model::$CUSTOMER})) {

            $customer                                                   = Customer::find($student->{Model::$CUSTOMER});
            $user_customer                                              = $customer->getUser;

            if (UserTrait::isActivated($user_customer) && $customer->getStudents->count() > 1) {

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

        $rules[Model::$STUDENT_MIN]                                         = ['numeric'];
        $rules[Model::$STUDENT_MAX]                                         = ['numeric'];

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
            'Stella Maris College',
            'Bonnefantencollege'
        ];
    }



    public static function getNiveauText($niveau) {

        switch ($niveau) {

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
            case 13:                                        return "MBO-1";
            case 14:                                        return "MBO-2";
            case 15:                                        return "MBO-3";
            case 16:                                        return "MBO-4";
            case 17:                                        return "HBO Associate degree";
            case 18:                                        return "HBO Bachelor";
            case 19:                                        return "HBO Master";
            case 20:                                        return "WO Bachelor";
            case 21:                                        return "WO Pre-master";
            case 22:                                        return "WO Master";
            case 23:                                        return "Basisschool";
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
            12                                              => self::getNiveauText(12),
            13                                              => self::getNiveauText(13),
            14                                              => self::getNiveauText(14),
            15                                              => self::getNiveauText(15),
            16                                              => self::getNiveauText(16),
            17                                              => self::getNiveauText(17),
            18                                              => self::getNiveauText(18),
            19                                              => self::getNiveauText(19),
            20                                              => self::getNiveauText(20),
            21                                              => self::getNiveauText(21),
            22                                              => self::getNiveauText(22),
            23                                              => self::getNiveauText(23)
        ];
    }



    public static function getLeerjaarData() {

        return [
            1                                               => 1,
            2                                               => 2,
            3                                               => 3,
            4                                               => 4,
            5                                               => 5,
            6                                               => 6,
            7                                               => 7,
            8                                               => 8
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
            'Onderbouw',
            'PIE',
            'VRTE',
            'ZWE',
        ];
    }





}
