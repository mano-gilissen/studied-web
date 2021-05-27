<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Person extends Model {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'person';



    public function getAddress() {

        return self::getThisToOne(self::$ADDRESS);

    }



}
