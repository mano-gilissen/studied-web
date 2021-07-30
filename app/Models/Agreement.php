<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Agreement extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'agreement';



    public function getStudent() {

        return self::getThisToOne(Model::$USER, Model::$STUDENT);

    }



    public function getEmployee() {

        return self::getThisToOne(Model::$USER, Model::$EMPLOYEE);

    }



    public function getSubject() {

        return self::getThisToOne(Model::$SUBJECT);

    }



    public function hasTrial() {

        return $this->getTrial()->exists();

    }

    public function getTrial() {

        return self::getThisToOne(Model::$STUDY, Model::$AGREEMENT_TRIAL);

    }



}
