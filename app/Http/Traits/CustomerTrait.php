<?php



namespace App\Http\Traits;

use App\Http\Support\Model;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;



trait CustomerTrait {





    public static function create(array $data) {

        self::validate($data);

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



    public static function update(array $data, $customer) {

        self::validate($data);

        $customer->{Model::$CUSTOMER_REFER}                     = $data[Model::$CUSTOMER_REFER];

        $customer->save();

        return $customer;
    }



    public static function validate(array $data) {

        $rules                                                  = [];

        // TODO: ADD RULES

        $validator                                              = Validator::make($data, $rules, BaseTrait::getValidationMessages());

        $validator->validate();
    }





    public static function hasMultipleStudents($customer) {

        return $customer->getStudents->count() > 1;

    }





}
