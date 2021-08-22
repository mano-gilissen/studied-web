<?php



namespace App\Http\Traits;

use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Person;
use App\Models\Role;


trait PersonTrait {





    public static function create(array $data, &$person) {

        $person                                                 = new Person;

        $person->{Model::$PERSON_PREFIX}                        = $data[Model::$PERSON_PREFIX];
        $person->{Model::$PERSON_FIRST_NAME}                    = $data[Model::$PERSON_FIRST_NAME];
        $person->{Model::$PERSON_MIDDLE_NAME}                   = $data[Model::$PERSON_MIDDLE_NAME]; // TODO: Test if not in $data (Field empty)
        $person->{Model::$PERSON_LAST_NAME}                     = $data[Model::$PERSON_LAST_NAME];
        $person->{Model::$PERSON_BIRTH_DATE}                    = $data[Model::$PERSON_BIRTH_DATE] . ' 00:00:00';

        $person->{Model::$PERSON_SLUG}                          = self::createSlug($person);

        $person->save();
    }



    public static function createSlug($person) {

        return str_replace(' ', '-', strtolower($person->{Model::$PERSON_FIRST_NAME} . ' ' . (strlen($person->{Model::$PERSON_MIDDLE_NAME}) > 0 ? $person->{Model::$PERSON_MIDDLE_NAME} . ' ' : '') . $person->{Model::$PERSON_LAST_NAME}));

    }





    public static function getFullName($person, $with_prefix = false) {

        if (!$person) {

            return false;

        }

        $prefix                                                 = $person->{Model::$PERSON_PREFIX};
        $first_name                                             = $person->{Model::$PERSON_FIRST_NAME};
        $middle_name                                            = $person->{Model::$PERSON_MIDDLE_NAME};
        $last_name                                              = $person->{Model::$PERSON_LAST_NAME};

        return ($with_prefix && $prefix ? $prefix . ' ': '') . $first_name . ' ' . ($middle_name ? $middle_name . ' ' : '') . $last_name;
    }



    public static function getInitials($person) {

        if (!$person) {

            return false;

        }

        $first_name                                             = $person->{Model::$PERSON_FIRST_NAME};
        $last_name                                              = $person->{Model::$PERSON_LAST_NAME};

        return substr($first_name, 0, 1) . substr($last_name, 0, 1) ;
    }



    public static function getSubtitle($person) {

        if (!$person) {

            return false;

        }

        $user                                                   = $person->getUser;

        switch($user->role) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_EMPLOYEE:
                return $user->getEmployee->{Model::$EMPLOYEE_SCHOOL_CURRENT} ?? UserTrait::getRoleName($user, true);
            case RoleTrait::$ID_STUDENT:
                return $user->getStudent->{Model::$STUDENT_SCHOOL};
            case RoleTrait::$ID_CUSTOMER:
                return UserTrait::getRoleName($user, true);
            default:
                return "Gebruiker";
        }
    }



    public static function getProfileComment($person) {

        return "Hoi ik ben een test comment voor de profielpagina van " . $person->{Model::$PERSON_FIRST_NAME} . " " . $person->{Model::$PERSON_LAST_NAME};

    }



    public static function getPrefixData() {

        return [
            "Dhr.",
            "Mevr.",
            "Mr.",
            "Mw.",
        ];
    }





}
