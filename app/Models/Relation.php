<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Relation extends Model {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'relation';



    public function getPerson() {

        return self::getThisToOne(self::$PERSON);

    }



}
