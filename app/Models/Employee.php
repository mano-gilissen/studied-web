<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Employee extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'employee',
        $dates                                  = ['start_employment'];



    public function getUser() {

        return self::getThisToOne(Model::$USER);

    }



    public function getArea() {

        return self::getThisToOne(Model::$AREA);

    }



    public function getStudents() {

        return self::getManyToMany(Model::$STUDENT, Model::$AGREEMENT, Model::$EMPLOYEE);

    }





}
