<?php



namespace App\Http\Traits;

use App\Http\Support\Model;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;



trait AddressTrait {





    public static

        $FORMAT_STUDY                                                   = 0;





    public static function create(array $data) {

        self::validate($data);

        $address                                                        = new Address;

        $address->{Model::$ADDRESS_STREET}                              = $data[Model::$ADDRESS_STREET];
        $address->{Model::$ADDRESS_NUMBER}                              = $data[Model::$ADDRESS_NUMBER];
        $address->{Model::$ADDRESS_ADDITION}                            = $data[Model::$ADDRESS_ADDITION];
        $address->{Model::$ADDRESS_ZIPCODE}                             = $data[Model::$ADDRESS_ZIPCODE];
        $address->{Model::$ADDRESS_CITY}                                = $data[Model::$ADDRESS_CITY];
        $address->{Model::$ADDRESS_COUNTRY}                             = $data[Model::$ADDRESS_COUNTRY];

        $address->save();

        return $address;
    }



    public static function update(array $data, $address) {

        self::validate($data);

        $address->{Model::$ADDRESS_STREET}                              = $data[Model::$ADDRESS_STREET];
        $address->{Model::$ADDRESS_NUMBER}                              = $data[Model::$ADDRESS_NUMBER];
        $address->{Model::$ADDRESS_ADDITION}                            = $data[Model::$ADDRESS_ADDITION];
        $address->{Model::$ADDRESS_ZIPCODE}                             = $data[Model::$ADDRESS_ZIPCODE];
        $address->{Model::$ADDRESS_CITY}                                = $data[Model::$ADDRESS_CITY];
        $address->{Model::$ADDRESS_COUNTRY}                             = $data[Model::$ADDRESS_COUNTRY];

        $address->save();

        return $address;

    }



    public static function validate(array $data) {

        $rules                                                          = [];

        $rules[Model::$ADDRESS_STREET]                                  = ['required'];
        $rules[Model::$ADDRESS_NUMBER]                                  = ['required'];
        $rules[Model::$ADDRESS_ZIPCODE]                                 = ['required', 'max:20'];
        $rules[Model::$ADDRESS_CITY]                                    = ['required'];
        $rules[Model::$ADDRESS_COUNTRY]                                 = ['required'];

        $validator                                                      = Validator::make($data, $rules, BaseTrait::getValidationMessages());

        $validator->validate();
    }





    public static function getFormatted($address, $format) {

        if (!$address) {

            return false;

        }

        switch ($format){

            case self::$FORMAT_STUDY:
            default: return                                             $address->{Model::$ADDRESS_STREET} . ' ' .
                                                                        $address->{Model::$ADDRESS_NUMBER} . ', ' .
                                                                        $address->{Model::$ADDRESS_ZIPCODE};
        }
    }





}
