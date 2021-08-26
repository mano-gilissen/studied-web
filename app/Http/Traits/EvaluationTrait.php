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

        $evaluation->{Model::$EVALUATION_DATETIME}                  = $data[Model::$EVALUATION_DATETIME];
        $evaluation->{Model::$EVALUATION_REGARDING}                 = $data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION_DATETIME];

        $evaluation->save();

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
