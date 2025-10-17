<?php



namespace App\Http\Traits;

use App\Models\Customer;
use App\Http\Support\Model;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


trait CustomerTrait {





    public static function create(array $data) {

        UserTrait::validate($data, null, [
            Model::$USER_CATEGORY                               => "required"
        ]);

        $customer                                               = new Customer;
        $user                                                   = UserTrait::create($data, RoleTrait::$ID_CUSTOMER);

        if (!$user) {

            return false;

        }

        $customer->{Model::$USER}                               = $user->{Model::$BASE_ID};

        $customer->save();

        return $customer;
    }



    public static function update(array $data, $customer) {

        UserTrait::validate($data, $customer->getUser, [
            Model::$USER_CATEGORY                               => "required"
        ]);

        // No additional fields to set for Customer at this time

        $customer->save();

        return $customer;
    }





    public static function hasMultipleStudents($customer) {

        return $customer->getStudents->count() > 1;

    }



    public static function getStudentsText($customer, $en = false) {

        $students = User::whereHas('getStudent.getCustomer', function ($q) use ($customer) {$q->where(Model::$CUSTOMER, $customer->{Model::$BASE_ID});})
            ->with('getPerson')
            ->get();

        switch (count($students)) {
            case 0:                                             return __("Geen leerlingen");
            case 1:                                             return PersonTrait::getFullName($students[0]->getPerson);
            default:                                            return implode($en ? __(" en ") : ", ", $students->pluck('getPerson.' . Model::$PERSON_FIRST_NAME)->toArray());
        }
    }



    public static function getCategoryData() {

        return [
            RoleTrait::$CATEGORY_CUSTOMER_PARENT                => __("Ouder/verzorger"),
            RoleTrait::$CATEGORY_CUSTOMER_COMPANY               => __("Bedrijf")
        ];
    }





}
