<?php



namespace App\Http\Traits;

use App\Models\Evaluation_employee;
use App\Http\Support\Model;



trait Evaluation_EmployeeTrait {



    public static function create($evaluation, $employee) {

        $evaluation_employee                                = new Evaluation_employee;

        $evaluation_employee->{Model::$EVALUATION}          = $evaluation->{Model::$BASE_ID};
        $evaluation_employee->{Model::$EMPLOYEE}            = $employee->{Model::$BASE_ID};

        $evaluation_employee->save();
    }



}
