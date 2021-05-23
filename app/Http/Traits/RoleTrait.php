<?php



namespace App\Http\Traits;

use App\Models\Person;



trait RoleTrait {



    public static

        $ROLE                                           = 'role',

        $ROLE_LABEL                                     = 'label',

        $ID_ADMINISTRATOR                               = 1,
        $ID_BOARD                                       = 2,
        $ID_MANAGEMENT                                  = 3,
        $ID_EMPLOYEE                                    = 4,
        $ID_STUDENT                                     = 5,
        $ID_CLIENT                                      = 6;



}
