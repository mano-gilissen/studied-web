<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Report_subject extends Model {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'report_subject';



    public function getSubject() {

        return self::getThisToOne(self::$SUBJECT);

    }



}
