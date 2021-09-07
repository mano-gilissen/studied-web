<?php



namespace App\Http\Traits;

use App\Http\Support\Func;
use App\Http\Support\Model;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;



trait EmployeeTrait {





    public static function create(array $data, $request) {



        $employee                                                       = new Employee;
        $filename = '';

        if ($request->hasFile('diploma') && $request->file('diploma')->isValid()) {

            $extension                                                  = $request->file('diploma')->extension();
            $filename                                                   = 'diploma_' . Func::generate_key() . '.' . $extension;

            $request->file('diploma')->store('diplomas', $filename);

            $employee->{Model::$EMPLOYEE_DIPLOMA}                       = $filename;
            $employee->save();
        }



        dd($filename);



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

        $employee->save();



        return $employee;
    }



    public static function update(array $data, $employee) {

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
