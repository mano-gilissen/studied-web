<?php



namespace App\Http\Traits;

use App\Http\Support\Files;
use App\Http\Support\Func;
use App\Http\Support\Model;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;



trait EmployeeTrait {





    public static function create(array $data, $request) {



        self::validate($data);



        $employee                                                       = new Employee;
        $user                                                           = UserTrait::create($data, RoleTrait::$ID_EMPLOYEE);

        if (!$user) {

            return false;

        }

        $employee->{Model::$USER}                                       = $user->{Model::$BASE_ID};

        $employee->{Model::$EMPLOYEE_EDUCATION_CURRENT}                 = $data[Model::$EMPLOYEE_EDUCATION_CURRENT];
        $employee->{Model::$EMPLOYEE_SCHOOL_CURRENT}                    = $data[Model::$EMPLOYEE_SCHOOL_CURRENT];
        $employee->{Model::$EMPLOYEE_PROFILE_CURRENT}                   = $data[Model::$EMPLOYEE_PROFILE_CURRENT];

        $employee->{Model::$EMPLOYEE_EDUCATION_MIDDELBARE}              = $data[Model::$EMPLOYEE_EDUCATION_MIDDELBARE];
        $employee->{Model::$EMPLOYEE_SCHOOL_MIDDELBARE}                 = $data[Model::$EMPLOYEE_SCHOOL_MIDDELBARE];
        $employee->{Model::$EMPLOYEE_PROFILE_MIDDELBARE}                = $data[Model::$EMPLOYEE_PROFILE_MIDDELBARE];

        $employee->{Model::$EMPLOYEE_MOTIVATION}                        = $data[Model::$EMPLOYEE_MOTIVATION];
        $employee->{Model::$EMPLOYEE_REFER}                             = $data[Model::$EMPLOYEE_REFER];
        $employee->{Model::$EMPLOYEE_CAPACITY}                          = $data[Model::$EMPLOYEE_CAPACITY];
        $employee->{Model::$EMPLOYEE_IBAN}                              = $data[Model::$EMPLOYEE_IBAN];



        $file_name_diploma                                              = Files::storeFile($request, Model::$EMPLOYEE_DIPLOMA, $employee->{Model::$BASE_ID});
        $employee->{Model::$EMPLOYEE_DIPLOMA}                           = $file_name_diploma;



        $employee->save();



        return $employee;
    }



    public static function update(array $data, $request, $employee) {



        self::validate($data);



        $employee->{Model::$EMPLOYEE_EDUCATION_CURRENT}                 = $data[Model::$EMPLOYEE_EDUCATION_CURRENT];
        $employee->{Model::$EMPLOYEE_SCHOOL_CURRENT}                    = $data[Model::$EMPLOYEE_SCHOOL_CURRENT];
        $employee->{Model::$EMPLOYEE_PROFILE_CURRENT}                   = $data[Model::$EMPLOYEE_PROFILE_CURRENT];

        $employee->{Model::$EMPLOYEE_EDUCATION_MIDDELBARE}              = $data[Model::$EMPLOYEE_EDUCATION_MIDDELBARE];
        $employee->{Model::$EMPLOYEE_SCHOOL_MIDDELBARE}                 = $data[Model::$EMPLOYEE_SCHOOL_MIDDELBARE];
        $employee->{Model::$EMPLOYEE_PROFILE_MIDDELBARE}                = $data[Model::$EMPLOYEE_PROFILE_MIDDELBARE];

        $employee->{Model::$EMPLOYEE_MOTIVATION}                        = $data[Model::$EMPLOYEE_MOTIVATION];
        $employee->{Model::$EMPLOYEE_REFER}                             = $data[Model::$EMPLOYEE_REFER];
        $employee->{Model::$EMPLOYEE_CAPACITY}                          = $data[Model::$EMPLOYEE_CAPACITY];
        $employee->{Model::$EMPLOYEE_IBAN}                              = $data[Model::$EMPLOYEE_IBAN];



        $file_name_diploma                                              = Files::storeFile($request, Model::$EMPLOYEE_DIPLOMA, $employee->{Model::$BASE_ID});

        if (strlen($file_name_diploma) > 0) {

            $employee->{Model::$EMPLOYEE_DIPLOMA}                       = $file_name_diploma;

        }



        $employee->save();



        return $employee;
    }



    public static function validate(array $data) {

        $rules                                                          = [];

        $rules[Model::$EMPLOYEE_CAPACITY]                               = "required|numeric";
        $rules[Model::$EMPLOYEE_IBAN]                                   = "max:20";

        $validator                                                      = Validator::make($data, $rules, BaseTrait::getValidationMessages());

        $validator->validate();
    }





}
