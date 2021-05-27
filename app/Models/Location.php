<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Location extends Model {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'location';



    public function getAddress() {

        return self::getThisToOne(self::$ADDRESS);

    }



    public function getArea() {

        return self::getThisToOne(self::$AREA);

    }



}
