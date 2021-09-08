<?php



namespace App\Models;

use App\Http\Support\Model;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Study_user extends ModelClass {



    use SoftDeletes;



    protected

        $table                                  = 'study_user';



    public function getStudy() {

        return self::getThisToOne(Model::$STUDY);

    }



    public function getUser() {

        return self::getThisToOne(Model::$STUDY);

    }



    public function getAgreement() {

        return self::getThisToOne(Model::$AGREEMENT);

    }



}
