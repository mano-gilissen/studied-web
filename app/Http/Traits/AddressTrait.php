<?php



namespace App\Http\Traits;



trait AddressTrait {



    public static

        $ADDRESS                                    = 'address',

        $ADDRESS_STREET                             = 'street',
        $ADDRESS_NUMBER                             = 'number',
        $ADDRESS_ADDITION                           = 'addition',
        $ADDRESS_ZIPCODE                            = 'zipcode',
        $ADDRESS_CITY                               = 'city',
        $ADDRESS_COUNTRY                            = 'country',

        $FORMAT_STUDY                               = 0;



    public static function getFormatted($address, $format) {

        if (!$address) {

            return false;

        }

        switch ($format){

            case self::$FORMAT_STUDY:
            default: return                         $address->{self::$ADDRESS_STREET} . ' ' .
                                                    $address->{self::$ADDRESS_NUMBER} . ', ' .
                                                    $address->{self::$ADDRESS_ZIPCODE};
        }
    }



}
