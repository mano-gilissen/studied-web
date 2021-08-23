<?php



namespace App\Http\Traits;

use App\Http\Support\Model;
use App\Models\Customer;



trait CustomerTrait {



    public static function create(array $data) {

        $customer                                               = new Customer;
        $user                                                   = UserTrait::create($data, RoleTrait::$ID_CUSTOMER);

        if (!$user) {

            return false;

        }

        $customer->{Model::$USER}                               = $user->{Model::$BASE_ID};
        $customer->{Model::$CUSTOMER_REFER}                     = $data[Model::$CUSTOMER_REFER];

        $customer->save();

        return $customer;
    }



    public static function hasMultipleStudents($customer) {

        return $customer->getStudents->count() > 1;

    }



}
