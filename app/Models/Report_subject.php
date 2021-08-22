<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Report_subject extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'report_subject';



    public function getSubject() {

        return self::getThisToOne(Model::$SUBJECT);

    }



    public function getAgreement() {

        return self::getThisToOne(Model::$AGREEMENT);

    }



}
