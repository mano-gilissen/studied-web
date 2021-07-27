<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Person extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'person';



    public function getUser() {

        return self::getOneToThis(Model::$USER, Model::$PERSON);

    }

    public function getAddress() {

        return self::getThisToOne(Model::$ADDRESS);

    }



}
