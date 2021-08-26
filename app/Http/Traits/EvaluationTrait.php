<?php



namespace App\Http\Traits;

use App\Http\Support\Color;
use App\Http\Support\Func;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Evaluation;


trait EvaluationTrait {





    public static

        $ID_INTAKE                              = 1,
        $ID_EVALUATION                          = 2,

        $STATUS_PLANNED                         = 1,
        $STATUS_FINISHED                        = 2;





    public static function create($data) {

        $evaluation                                                 = new Evaluation();

        $evaluation->{Model::$BASE_KEY}                             = Func::generate_key();

        $evaluation->{Model::$EVALUATION_DATETIME}                  = $data['date'] . ' ' . $data['start'] . ':00';
        $evaluation->{Model::$EVALUATION_REGARDING}                 = $data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION_REGARDING];
        $evaluation->{Model::$EVALUATION_HOST}                      = $data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION_HOST];
        $evaluation->{Model::$STUDENT}                              = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT];
        $evaluation->{Model::$EVALUATION_LOCATION_TEXT}             = $data[Key::AUTOCOMPLETE_ID . Model::$LOCATION];

        $evaluation->save();



        $employee_ids                                               = [];

        array_push($employee_ids, $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_1']);
        array_push($employee_ids, $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_2']);
        array_push($employee_ids, $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_3']);

        foreach ($employee_ids as $employee_id) {

            if ($employee_id > 0) {

                Evaluation_EmployeeTrait::create($evaluation->{Model::$BASE_ID}, $employee_id);

            }
        }



        dd($evaluation);



        return $evaluation;
    }





    public static function hasLink($study) {

        return strlen($study->link) > 0;

    }



    public static function getRegardingText($regarding) {

        switch ($regarding) {

            case self::$ID_INTAKE:

                return "Kennismaking";

            case self::$ID_EVALUATION:

                return "Evaluatie";

            default:

                return Key::UNKNOWN;
        }
    }




    public static function getRegardingData() {

        return [
            self::$ID_INTAKE                        => self::getRegardingText(self::$ID_INTAKE),
            self::$ID_EVALUATION                    => self::getRegardingText(self::$ID_EVALUATION)
        ];
    }



    public static function getStatus($evaluation) {

        return Func::has_passed($evaluation->{Model::$EVALUATION_DATETIME}) ? 1 : 2;

    }



    public static function getStatusText($status) {

        switch ($status) {
            case self::$STATUS_PLANNED:             return "Ingepland";
            case self::$STATUS_FINISHED:            return "Afgelopen";
            default:                                return Key::UNKNOWN;
        }
    }



    public static function getStatusTextColor($status) {

        switch ($status) {
            case self::$STATUS_PLANNED:             return Color::WHITE;
            case self::$STATUS_FINISHED:
            default:                                return Color::BLACK;
        }
    }



    public static function getStatusColor($status) {

        switch ($status) {
            case self::$STATUS_PLANNED:             return Color::GREEN;
            case self::$STATUS_FINISHED:
            default:                                return Color::GREY_90;
        }
    }





}
