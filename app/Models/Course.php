<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Course extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'course';



    public function getHost() {

        return self::getThisToOne(Model::$PERSON);

    }



}
