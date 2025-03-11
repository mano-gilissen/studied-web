<?php



namespace App\Http\Traits;

use App\Http\Support\Files;
use App\Http\Support\Format;
use App\Http\Support\Mail;
use App\Http\Support\Model;
use App\Models\Agreement;
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

        self::set($data, $request, $employee);

        $employee->save();

        return $employee;
    }



    public static function update(array $data, $request, $employee) {

        self::validate($data);

        self::set($data, $request, $employee);

        $employee->save();

        return $employee;
    }



    public static function set(array $data, $request, $employee) {



        $employee->{Model::$EMPLOYEE_PROFILE_TEXT}                      = array_key_exists(Model::$EMPLOYEE_PROFILE_TEXT, $data) ? $data[Model::$EMPLOYEE_PROFILE_TEXT] : '';

        $employee->{Model::$EMPLOYEE_EDUCATION_CURRENT}                 = $data[Model::$EMPLOYEE_EDUCATION_CURRENT];
        $employee->{Model::$EMPLOYEE_SCHOOL_CURRENT}                    = $data[Model::$EMPLOYEE_SCHOOL_CURRENT];
        $employee->{Model::$EMPLOYEE_PROFILE_CURRENT}                   = $data[Model::$EMPLOYEE_PROFILE_CURRENT];

        $employee->{Model::$EMPLOYEE_EDUCATION_MIDDELBARE}              = $data[Model::$EMPLOYEE_EDUCATION_MIDDELBARE];
        $employee->{Model::$EMPLOYEE_SCHOOL_MIDDELBARE}                 = $data[Model::$EMPLOYEE_SCHOOL_MIDDELBARE];
        $employee->{Model::$EMPLOYEE_PROFILE_MIDDELBARE}                = $data[Model::$EMPLOYEE_PROFILE_MIDDELBARE];

        $employee->{Model::$EMPLOYEE_MOTIVATION}                        = $data[Model::$EMPLOYEE_MOTIVATION];
        $employee->{Model::$EMPLOYEE_CAPACITY}                          = $data[Model::$EMPLOYEE_CAPACITY];
        $employee->{Model::$EMPLOYEE_IBAN}                              = $data[Model::$EMPLOYEE_IBAN];



        $employee->save();



        $file_name_cv                                                   = Files::storeFile($request, Model::$EMPLOYEE_CV, $employee->{Model::$BASE_ID});
        $employee->{Model::$EMPLOYEE_CV}                                = strlen($file_name_cv) > 0 ? $file_name_cv : $employee->{Model::$EMPLOYEE_CV};

        $file_name_diploma                                              = Files::storeFile($request, Model::$EMPLOYEE_DIPLOMA, $employee->{Model::$BASE_ID});
        $employee->{Model::$EMPLOYEE_DIPLOMA}                           = strlen($file_name_diploma) > 0 ? $file_name_diploma : $employee->{Model::$EMPLOYEE_DIPLOMA};

        $file_name_contract                                             = Files::storeFile($request, Model::$EMPLOYEE_CONTRACT, $employee->{Model::$BASE_ID});
        $employee->{Model::$EMPLOYEE_CONTRACT}                          = strlen($file_name_contract) > 0 ? $file_name_contract : $employee->{Model::$EMPLOYEE_CONTRACT};

        $file_name_loonheffing                                          = Files::storeFile($request, Model::$EMPLOYEE_LOONHEFFING, $employee->{Model::$BASE_ID});
        $employee->{Model::$EMPLOYEE_LOONHEFFING}                       = strlen($file_name_loonheffing) > 0 ? $file_name_loonheffing : $employee->{Model::$EMPLOYEE_LOONHEFFING};

        $file_name_identificatie                                        = Files::storeFile($request, Model::$EMPLOYEE_IDENTIFICATIE, $employee->{Model::$BASE_ID});
        $employee->{Model::$EMPLOYEE_IDENTIFICATIE}                     = strlen($file_name_identificatie) > 0 ? $file_name_identificatie : $employee->{Model::$EMPLOYEE_IDENTIFICATIE};

        $file_name_indiensttreding                                      = Files::storeFile($request, Model::$EMPLOYEE_INDIENSTTREDING, $employee->{Model::$BASE_ID});
        $employee->{Model::$EMPLOYEE_INDIENSTTREDING}                   = strlen($file_name_indiensttreding) > 0 ? $file_name_indiensttreding : $employee->{Model::$EMPLOYEE_INDIENSTTREDING};
    }



    public static function validate(array $data) {

        $rules                                                          = [];

        $rules[Model::$EMPLOYEE_CAPACITY]                               = "required|numeric";
        $rules[Model::$EMPLOYEE_IBAN]                                   = "max:30";

        $validator                                                      = Validator::make($data, $rules, BaseTrait::getValidationMessages());

        $validator->validate();
    }



    public static function start_employment($employee) {

        $employee->{Model::$EMPLOYEE_START_EMPLOYMENT}                  = date(Format::$DATABASE_DATETIME);

        $employee->save();
    }



    public static function calculate_deficit($employee) {

        $total = 0;
        $agreements = Agreement::where(Model::$EMPLOYEE, $employee->user)
            ->where(Model::$AGREEMENT_END, '>', date(Format::$DATABASE_DATE))
            ->where(Model::$AGREEMENT_START, '<', date(Format::$DATABASE_DATE))
            ->get();

        foreach ($agreements as $agreement) {

            $deficit = AgreementTrait::calculateDeficit($agreement);

            if ($deficit > 0) {

                $total += $deficit;

            }
        }

        return $total;
    }





}
