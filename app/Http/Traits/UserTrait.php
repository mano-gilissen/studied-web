<?php



namespace App\Http\Traits;



use App\Http\Support\Color;
use App\Http\Support\Key;
use App\Http\Support\Model;
use Auth;



trait UserTrait {





    public static

        $STATUS_INTAKE                                      = 1,
        $STATUS_ACTIVE                                      = 2,
        $STATUS_PASSIVE                                     = 3,
        $STATUS_ENDED                                       = 4;





    public static function getRoleName($user, $public = false) {

        $role                   = $user->getRole;

        if (!$role) {

            return false;

        }

        return $public ? $role->{Model::$ROLE_LABEL_PUBLIC} : $role->{Model::$ROLE_LABEL};
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
