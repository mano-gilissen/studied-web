<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;



class Customer extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'customer';



    public function getUser() {

        return self::getThisToOne(Model::$USER);

    }



    public function getStudents() {

        return self::getOneToMany(Model::$STUDENT, Model::$CUSTOMER);

    }



    public function isStudent($student) {

        return in_array($student->{Model::$BASE_ID}, Auth::user()->getCustomer->getStudents->pluck(Model::$BASE_ID)->toArray());

    }



}
