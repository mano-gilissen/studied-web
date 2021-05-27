<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Employee extends Model {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'employee';



    /**   Add hasOneThrough Employee->Person   */

    public function getUser() {

        return self::getThisToOne(self::$USER);

    }



    public function getArea() {

        return self::getThisToOne(self::$AREA);

    }



}
