<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Agreement extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'agreement',
        $dates                                  = ['start', 'end'];



    public function getStudent() {

        return self::getThisToOne(Model::$USER, Model::$STUDENT);

    }



    public function getEmployee() {

        return self::getThisToOne(Model::$USER, Model::$EMPLOYEE);

    }



    public function getService() {

        return self::getThisToOne(Model::$SERVICE);

    }



    public function getSubject() {

        return self::getThisToOne(Model::$SUBJECT);

    }



    public function getLevel() {

        return self::getThisToOne(Model::$LEVEL);

    }



}
