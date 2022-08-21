<?php



namespace App\Http\Traits;

use App\Http\Support\Color;
use App\Http\Support\Func;
use App\Http\Support\Key;
use App\Http\Support\Mail;
use App\Http\Support\Model;
use App\Models\Address;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Support\Facades\Validator;



trait EvaluationTrait {





    public static

        $ID_INTAKE                              = 1,
        $ID_EVALUATION                          = 2,
        $ID_YEAR_END                            = 3,
        $ID_EXIT                                = 4,

        $STATUS_PLANNED                         = 1,
        $STATUS_FINISHED                        = 2;





    public static function create($data) {

        self::validate($data);

        $evaluation                                                 = new Evaluation();

        $evaluation->{Model::$BASE_KEY}                             = Func::generate_key();

        $evaluation->{Model::$EVALUATION_DATETIME}                  = $data['date'] . ' ' . $data['start'] . ':00';
        $evaluation->{Model::$EVALUATION_REGARDING}                 = $data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION_REGARDING];
        $evaluation->{Model::$EVALUATION_HOST}                      = $data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION_HOST];
        $evaluation->{Model::$STUDENT}                              = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT];

        $address                                                    = Address::find($data[Key::AUTOCOMPLETE_ID . Model::$LOCATION]);
        $location                                                   = $address ? $address->getLocation : null;
        $link                                                       = $data[Model::$EVALUATION_LINK];

        $evaluation->{Model::$ADDRESS}                              = $address ? $address->{Model::$BASE_ID} : -1;
        $evaluation->{Model::$EVALUATION_LOCATION_TEXT}             = $link ? "Digitaal" : ($location ? $location->{Model::$LOCATION_NAME} : $data[Model::$LOCATION]);
        $evaluation->{Model::$EVALUATION_LINK}                      = $link;



        $evaluation->save();



        $employee_ids                                               = [];

        array_push($employee_ids, $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_1']);
        array_push($employee_ids, $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_2']);
        array_push($employee_ids, $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . '_3']);

        foreach ($employee_ids as $employee_id) {

            if ($employee_id > 0) {

                Evaluation_EmployeeTrait::create($evaluation->{Model::$BASE_ID}, $employee_id);

                Mail::evaluationCreated_forEmployee(User::find($employee_id), $evaluation);
            }
        }



        $user_host                                                  = User::find($evaluation->{Model::$EVALUATION_HOST});
        $user_student                                               = User::find($evaluation->{Model::$STUDENT});

        Mail::evaluationCreated_forHost($user_host, $evaluation);

        if (UserTrait::isActivated($user_student)) {

            Mail::evaluationCreated_forStudent($user_student, $evaluation);

        }

        if (StudentTrait::hasCustomer($user_student->getStudent)) {

            $user_customer = $user_student->getStudent->getCustomer->getUser;

            if (UserTrait::isActivated($user_customer)) {

                Mail::evaluationCreated_forCustomer($user_customer, $evaluation);

            }
        }



        return $evaluation;
    }




    public static function updateFromEvaluation($data, $evaluation) {

        self::validate($data);

        for ($i = 1; $i <= 56; $i++) {

            if (array_key_exists(Model::$EVALUATION_QUESTION . $i, $data)) {

                $evaluation[Model::$EVALUATION_QUESTION . $i]               = $data[Model::$EVALUATION_QUESTION . $i];

            }
        }

        $evaluation[Model::$EVALUATION_PERFORMED]                           = true;
        $evaluation[Model::$EVALUATION_REMARKS]                             = $data[Model::$EVALUATION_REMARKS];

        $evaluation->save();
    }



    public static function validate(array $data) {

        $messages                                                           = [
            'max'                                                           => 'Gebruik maximaal :max karakters.'
        ];

        $rules                                                              = [];

        foreach ($data as $key => $value) {

            if (Func::contains($key, [Model::$EVALUATION_QUESTION])) {

                $rules[$key]                                                = ['max:999'];

            }

            if (Func::contains($key, [Model::$EVALUATION_REMARKS])) {

                $rules[$key]                                                = ['max:4999'];

            }
        }

        $validator                                                          = Validator::make($data, $rules, $messages);

        $validator->validate();
    }





    public static function hasLink($evaluation) {

        return strlen($evaluation->link) > 0;

    }



    public static function getRegardingText($regarding) {

        switch ($regarding) {

            case self::$ID_INTAKE:

                return "Kennismakingsgesprek";

            case self::$ID_EVALUATION:

                return "Evaluatiegesprek";

            case self::$ID_YEAR_END:

                return "Eindejaarsgesprek";

            case self::$ID_EXIT:

                return "Exitgesprek";

            default:

                return "Gesprek";
        }
    }



    public static function getRegardingData() {

        return [
            self::$ID_INTAKE                        => self::getRegardingText(self::$ID_INTAKE),
            self::$ID_EVALUATION                    => self::getRegardingText(self::$ID_EVALUATION),
            self::$ID_YEAR_END                      => self::getRegardingText(self::$ID_YEAR_END),
            self::$ID_EXIT                          => self::getRegardingText(self::$ID_EXIT)
        ];
    }



    public static function getStatus($evaluation) {

        return Func::has_passed($evaluation->{Model::$EVALUATION_DATETIME}) ? 2 : 1;

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
