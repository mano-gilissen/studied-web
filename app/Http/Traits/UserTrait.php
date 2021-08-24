<?php



namespace App\Http\Traits;



use App\Http\Support\Color;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\User;
use Auth;



trait UserTrait {





    public static

        $STATUS_INTAKE                                      = 1,
        $STATUS_ACTIVE                                      = 2,
        $STATUS_PASSIVE                                     = 3,
        $STATUS_ENDED                                       = 4;





    public static function create($data, $role) {

        $user                                               = new User;
        $person                                             = PersonTrait::create($data);
        $address                                            = AddressTrait::create($data);

        if (!$person || !$address) {

            return false;

        }

        $user->{Model::$PERSON}                             = $person->{Model::$BASE_ID};
        $person->{Model::$ADDRESS}                          = $address->{Model::$BASE_ID};

        $user->{Model::$USER_EMAIL}                         = $data[Model::$USER_EMAIL];
        $user->{Model::$ROLE}                               = $role;
        $user->{Model::$USER_STATUS}                        = self::$STATUS_INTAKE;

        $user->save();
        $person->save();
        $address->save();

        return $user;
    }




    public static function addValidationRules(&$rules) {

        $rules[Model::$USER_EMAIL]                          = ['required', 'email'];

    }





    public static function getRoleName($user, $public = false) {

        $role                                               = $user->getRole;

        if (!$role) {

            return false;

        }

        return $public ? $role->{Model::$ROLE_LABEL_PUBLIC} : $role->{Model::$ROLE_LABEL};
    }



    public static function getEvaluations($user) {

        $evaluations                                        = [];

        switch ($user->{Model::$ROLE}) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_EMPLOYEE:

                array_push($evaluations, $user->getEvaluations_asHost->toArray());
                array_push($evaluations, $user->getEvaluations_asEmployee->toArray());

                break;

            case RoleTrait::$ID_STUDENT:

                array_push($evaluations, $user->getEvaluations_asStudent->toArray());

                break;

            case RoleTrait::$ID_CUSTOMER:

                foreach ($user->getCustomer->getStudents as $student) {

                    array_push($evaluations, $student->getUser->getEvaluations_asStudent->toArray());

                }

                break;
        }

        return $evaluations;
    }



    public static function getStatusText($status) {

        switch ($status) {

            case self::$STATUS_INTAKE:                      return "Intake";
            case self::$STATUS_ACTIVE:                      return "Actief";
            case self::$STATUS_PASSIVE:                     return "Passief";
            case self::$STATUS_ENDED:                       return "Beëindigd";
            default:                                        return Key::UNKNOWN;
        }
    }



    public static function getStatusColor($status) {

        switch ($status) {

            case self::$STATUS_INTAKE:
            case self::$STATUS_PASSIVE:                     return Color::ORANGE;
            case self::$STATUS_ACTIVE:                      return Color::GREEN;
            case self::$STATUS_ENDED:
            default:                                        return Color::RED;
        }
    }



    public static function getStatusTextColor($status) {

        switch ($status) {

            case self::$STATUS_INTAKE:
            case self::$STATUS_ACTIVE:
            case self::$STATUS_PASSIVE:
            case self::$STATUS_ENDED:
            default:                                        return Color::WHITE;
        }
    }



    public static function getStatusFilterData() {

        return [
            self::$STATUS_INTAKE                            => self::getStatusText(self::$STATUS_INTAKE),
            self::$STATUS_ACTIVE                            => self::getStatusText(self::$STATUS_ACTIVE),
            self::$STATUS_PASSIVE                           => self::getStatusText(self::$STATUS_PASSIVE),
            self::$STATUS_ENDED                             => self::getStatusText(self::$STATUS_ENDED)
        ];
    }





}
