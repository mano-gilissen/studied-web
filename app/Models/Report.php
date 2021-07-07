<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Report extends Model {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'report';



    public function getStudy() {

        return self::getThisToOne(self::$STUDY);

    }



    public function getStudent() {

        return self::getThisToOne(self::$USER, self::$STUDENT);

    }



    public function getReport_Subjects() {

        return self::getOneToMany(self::$REPORT_SUBJECT, self::$REPORT);

    }



}
