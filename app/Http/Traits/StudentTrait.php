<?php



namespace App\Http\Traits;



trait StudentTrait {





    public static function hasCustomer($student) {

        return $student->getCustomer != null;

    }





}
