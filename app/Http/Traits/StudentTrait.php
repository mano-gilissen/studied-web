<?php



namespace App\Http\Traits;

use App\Http\Support\Key;
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

        $student->save();

        return $student;
    }



    public static function update(array $data, $student) {

        self::validate($data);

        $student->{Model::$CUSTOMER}                                        = $data[Key::AUTOCOMPLETE_ID . Model::$CUSTOMER];

        $student->{Model::$STUDENT_SCHOOL}                                  = $data[Model::$STUDENT_SCHOOL];
        $student->{Model::$STUDENT_PROFILE}                                 = $data[Model::$STUDENT_PROFILE];
        $student->{Model::$STUDENT_NIVEAU}                                  = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT_NIVEAU];
        $student->{Model::$STUDENT_LEERJAAR}                                = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT_LEERJAAR];

        $student->save();

        return $student;
    }



    public static function validate(array $data) {

        $rules                                                              = [];

        $rules[Model::$STUDENT_SCHOOL]                                      = ['required'];
        $rules[Model::$STUDENT_NIVEAU]                                      = ['required'];
        $rules[Model::$STUDENT_LEERJAAR]                                    = ['required'];

        $validator                                                          = Validator::make($data, $rules, self::getValidationMessages());

        $validator->validate();
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
            'Natuur & Techniek',
            'Economie & Maatschappij'
        ];
    }





}
