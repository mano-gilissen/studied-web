<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Relation extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'relation';



    public function getPerson() {

        return self::getThisToOne(Model::$PERSON);

    }



}
