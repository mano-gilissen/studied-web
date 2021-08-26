<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Evaluation extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'evaluation',
        $dates                                  = ['datetime'];



    public function getHost() {

        return self::getThisToOne(Model::$USER, Model::$EVALUATION_HOST);

    }



    public function getEmployees() {

        return self::getManyToMany(Model::$USER, Model::$EVALUATION_EMPLOYEE, Model::$EVALUATION, Model::$EMPLOYEE);

    }



    public function getStudent() {

        return self::getThisToOne(Model::$USER, Model::$EVALUATION_STUDENT);

    }



    public function getAddress() {

        return self::getThisToOne(Model::$ADDRESS);

    }



}
