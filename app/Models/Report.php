<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Report extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'report';



    public function getStudy() {

        return self::getThisToOne(Model::$STUDY);

    }



    public function getStudent() {

        return self::getThisToOne(Model::$USER, Model::$STUDENT);

    }



    public function getReport_Subjects() {

        return self::getOneToMany(Model::$REPORT_SUBJECT, Model::$REPORT);

    }



}
