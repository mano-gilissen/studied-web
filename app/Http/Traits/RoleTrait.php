<?php



namespace App\Http\Traits;



trait RoleTrait {





    public static

        $ID_ADMINISTRATOR                               = 1,
        $ID_BOARD                                       = 2,
        $ID_MANAGEMENT                                  = 3,
        $ID_EMPLOYEE                                    = 4,
        $ID_STUDENT                                     = 5,
        $ID_CUSTOMER                                    = 6,

        $CATEGORY_CUSTOMER_PARENT                       = 61,
        $CATEGORY_CUSTOMER_COMPANY                      = 62;





    public static function getName($roleId) {

        switch ($roleId) {
            case self::$ID_ADMINISTRATOR:
                return __('Administrator');
            case self::$ID_BOARD:
                return __('Board');
            case self::$ID_MANAGEMENT:
                return __('Management');
            case self::$ID_EMPLOYEE:
                return __('Medewerker');
            case self::$ID_STUDENT:
                return __('Leerling');
            case self::$ID_CUSTOMER:
                return __('Klant');
            default:
                return __('Publiek');
        }
    }





}
