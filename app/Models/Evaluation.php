<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Evaluation extends Model {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'evaluation';



    public function getHost() {

        return self::getThisToOne(self::$USER, self::$EVALUATION_HOST);

    }



    public function getEmployee() {

        return self::getThisToOne(self::$USER, self::$EVALUATION_EMPLOYEE);

    }



    public function getStudent() {

        return self::getThisToOne(self::$USER, self::$EVALUATION_STUDENT);

    }



    public function getLocation_Defined() {

        return self::getThisToOne(self::$LOCATION, self::$EVALUATION_LOCATION_DEFINED);

    }



}
