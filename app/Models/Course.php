<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Course extends Model {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'course';



    public function getHost() {

        return self::getThisToOne(self::$PERSON);

    }



}
