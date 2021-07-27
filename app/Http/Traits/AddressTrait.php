<?php



namespace App\Http\Traits;

use App\Http\Support\Model;



trait AddressTrait {





    public static

        $FORMAT_STUDY                               = 0;





    public static function getFormatted($address, $format) {

        if (!$address) {

            return false;

        }

        switch ($format){

            case self::$FORMAT_STUDY:
            default: return                         $address->{Model::$ADDRESS_STREET} . ' ' .
                                                    $address->{Model::$ADDRESS_NUMBER} . ', ' .
                                                    $address->{Model::$ADDRESS_ZIPCODE};
        }
    }





}
