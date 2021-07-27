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

        $table                                  = 'evaluation';



    public function getHost() {

        return self::getThisToOne(Model::$USER, Model::$EVALUATION_HOST);

    }



    public function getEmployee() {

        return self::getThisToOne(Model::$USER, Model::$EVALUATION_EMPLOYEE);

    }



    public function getStudent() {

        return self::getThisToOne(Model::$USER, Model::$EVALUATION_STUDENT);

    }



    public function getLocation_Defined() {

        return self::getThisToOne(Model::$LOCATION, Model::$EVALUATION_LOCATION_DEFINED);

    }



}
