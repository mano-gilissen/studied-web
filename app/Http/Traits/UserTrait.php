<?php



namespace App\Http\Traits;



use App\Http\Support\Model;
use Auth;



trait UserTrait {





    public static function getRoleName($user, $public = false) {

        $role                   = $user->getRole;

        if (!$role) {

            return false;

        }

        return $public ? $role->{Model::$ROLE_LABEL_PUBLIC} : $role->{Model::$ROLE_LABEL};
    }





}
