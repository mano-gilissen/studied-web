<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Location extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'location';



    public function getAddress() {

        return self::getThisToOne(Model::$ADDRESS);

    }



    public function getArea() {

        return self::getThisToOne(Model::$AREA);

    }



}
