<?php



namespace App\Http\Traits;



trait CustomerTrait {



    public static function hasMultipleStudents($customer) {

        return $customer->getStudents->count() > 1;

    }



}
