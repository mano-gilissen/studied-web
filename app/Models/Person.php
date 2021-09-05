<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Person extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'person',
        $dates                                  = ['birth_date'];



    public function getUser() {

        return self::getOneToThis(Model::$USER, Model::$PERSON);

    }

    public function getAddress() {

        return self::getThisToOne(Model::$ADDRESS);

    }



    public function getFullNameAttribute() {

        return PersonTrait::getFullName($this);

    }



}
