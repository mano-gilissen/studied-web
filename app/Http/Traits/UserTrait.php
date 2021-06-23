<?php



namespace App\Http\Traits;



use App\Models\User;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\RoleTrait;
use Auth;



trait UserTrait {





    use PersonTrait;
    use RoleTrait;





    public static

        $USER                                           = 'user',

        $USER_EMAIL                                     = 'email',
        $USER_PASSWORD                                  = 'password',
        $USER_NAME                                      = 'name';





    public static function getFullName($user, $with_prefix = false) {

        $person                 = $user->getPerson;

        if (!$person) {

            return false;

        }

        $prefix                 = $person->{self::$PERSON_PREFIX};
        $first_name             = $person->{self::$PERSON_FIRST_NAME};
        $middle_name            = $person->{self::$PERSON_MIDDLE_NAME};
        $last_name              = $person->{self::$PERSON_LAST_NAME};

        return ($with_prefix && $prefix ? $prefix . ' ': '') . $first_name . ' ' . ($middle_name ? $middle_name . ' ' : '') . $last_name;
    }



    public static function getInitials($user) {

        $person                 = $user->getPerson;

        if (!$person) {

            return false;

        }
        $first_name             = $person->{self::$PERSON_FIRST_NAME};
        $last_name              = $person->{self::$PERSON_LAST_NAME};

        return substr($first_name, 0, 1) . substr($last_name, 0, 1) ;
    }



    public static function getRoleName($user) {

        $role                   = $user->getRole;

        if (!$role) {

            return false;

        }

        return $role->{self::$ROLE_LABEL};
    }





}
