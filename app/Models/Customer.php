<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Customer extends Model {



    use SoftDeletes;
    use BaseTrait;



    protected

        $table                                  = 'customer';



    /**   Add hasOneThrough for Customer->Person   */

    public function getUser() {

        return self::getThisToOne(self::$USER);

    }



    public function getStudents() {

        return self::getOneToMany(self::$STUDENT, self::$CUSTOMER);

    }



}
