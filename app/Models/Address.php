<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Address extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'address';



    public function getLocation() {

        return self::getOneToThis(Model::$LOCATION, Model::$ADDRESS);

    }



    public function getPerson() {

        return self::getOneToThis(Model::$PERSON, Model::$ADDRESS);

    }



}
