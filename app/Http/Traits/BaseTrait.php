<?php



namespace App\Http\Traits;

use App\Http\Support\Model;
use Auth;



trait BaseTrait {



    public static

        $NAMESPACE_MODEL                        = "App\\Models\\";



    #   PLANE { PILOT: X }
    #   PILOT {          }

    #   PILOT->getOneToThis(self::$PLANE, self::$PILOT)

    public function getOneToThis($foreign, $key_foreign) {

        return $this->hasOne(self::getModelClass($foreign), $key_foreign);

    }



    #   PLANE { PILOT: X }
    #   PILOT {          }

    #   PLANE->getThisToOne(self::PILOT)

    public function getThisToOne($foreign, $key_local = null) {

        return $this->belongsTo(self::getModelClass($foreign), $key_local ? $key_local : $foreign);

    }



    #   PLANE { PILOT: X }
    #   PLANE { PILOT: X }
    #   PILOT {          }

    #   PILOT->getOneToMany(self::$PLANE, self::$PILOT);

    public function getOneToMany($foreign, $key_foreign, $key_local = null) {

        return $this->hasMany(self::getModelClass($foreign), $key_foreign, $key_local ? $key_local : Model::$BASE_ID);

    }



    #   PLANE {          }
    #   PILOT {          }
    #   PLANE_PILOT { PLANE: X; PILOT: X }

    #   PILOT->getManyToMany(self::$PLANE, self::$PLANE_PILOT, self::$PILOT);

    public function getManyToMany($foreign, $pivot, $local, $key_foreign = null, $key_local = null) {

        return $this->belongsToMany(self::getModelClass($foreign), $pivot, $key_local ? $key_local : $local, $key_foreign ? $key_foreign : $foreign);

    }



    public static function getModel($type) {

        return (ucfirst($type));

    }

    public static function getModelClass($type) {

        return self::$NAMESPACE_MODEL . self::getModel($type);

    }



    public static function getUserRole() {

        return Auth::user()->role;

    }

    public static function hasBoardRights() {

        return in_array(self::getUserRole(), [RoleTrait::$ID_ADMINISTRATOR, RoleTrait::$ID_BOARD]);

    }

    public static function hasManagementRights() {

        return in_array(self::getUserRole(), [RoleTrait::$ID_ADMINISTRATOR, RoleTrait::$ID_BOARD, RoleTrait::$ID_MANAGEMENT]);

    }

    public static function hasEmployeeRights() {

        return in_array(self::getUserRole(), [RoleTrait::$ID_ADMINISTRATOR, RoleTrait::$ID_BOARD, RoleTrait::$ID_MANAGEMENT, RoleTrait::$ID_EMPLOYEE]);

    }





    public static function getValidationMessages() {

        $messages                                                           = [];
        $messages['required']                                               = __('Dit veld is verplicht.');
        $messages['required_if']                                            = __('Dit veld is verplicht als de :other leeg is.');
        $messages['required_without']                                       = __('Dit veld is verplicht als de :values niet ingevuld zijn.');

        $messages['max']                                                    = __('Dit veld mag maximaal :max karakters bevatten.');

        $messages['numeric']                                                = __('Vul een getal in.');
        $messages['unique']                                                 = __('Dit email adres is al in gebruik.');
        $messages['zipcode.max']                                            = __('Vul een geldige postcode in.');
        $messages['iban.max']                                               = __('Vul een geldige IBAN in.');

        return $messages;
    }





}
