<?php



namespace App\Http\Traits;

use App\Models\Evaluation_employee;
use App\Http\Support\Model;



trait Evaluation_EmployeeTrait {



    public static function create($evaluation_id, $employee_id) {

        $evaluation_employee                                = new Evaluation_employee;

        $evaluation_employee->{Model::$EVALUATION}          = $evaluation_id;
        $evaluation_employee->{Model::$EMPLOYEE}            = $employee_id;

        $evaluation_employee->save();
    }



}
