<?php



namespace App\Http\Traits;

use App\Http\Support\Func;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Evaluation;


trait EvaluationTrait {





    public static

        $ID_INTAKE                              = 1,
        $ID_EVALUATION                          = 2;





    public static function create($data) {

        $evaluation                                                 = new Evaluation();

        $evaluation->{Model::$BASE_KEY}                             = Func::generate_key();

        $evaluation->{Model::$EVALUATION_DATETIME}                  = $data['date'] . ' ' . $data['start'] . ':00';
        $evaluation->{Model::$EVALUATION_REGARDING}                 = $data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION_DATETIME];
        $evaluation->{Model::$EVALUATION_HOST}                      = $data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION_HOST];
        $evaluation->{Model::$STUDENT}                              = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT];
        $evaluation->{Model::$LOCATION}                             = $data[Key::AUTOCOMPLETE_ID . Model::$LOCATION];

        dd($evaluation);

        $evaluation->save();



        $employee_ids                                               = [];

        array_push($employee_ids, $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_1']);
        array_push($employee_ids, $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_2']);

        foreach ($employee_ids as $employee_id) {

            if ($employee_id > 0) {

                Evaluation_EmployeeTrait::create($evaluation->{Model::$BASE_ID}, $employee_id);

            }
        }



        return $evaluation;
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





}
