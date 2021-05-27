<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Event extends Model {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'event';



    public function getUser() {

        return self::getThisToOne(self::$USER);

    }



    public function getLocation() {

        return self::getThisToOne(self::$LOCATION);

    }



}
