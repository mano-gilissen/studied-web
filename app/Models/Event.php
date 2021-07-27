<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Event extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'event';



    public function getUser() {

        return self::getThisToOne(Model::$USER);

    }



    public function getLocation() {

        return self::getThisToOne(Model::$LOCATION);

    }



}
