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





    public static function getRoleName($user) {

        $role                   = $user->getRole;

        if (!$role) {

            return false;

        }

        return $role->{self::$ROLE_LABEL};
    }





}
