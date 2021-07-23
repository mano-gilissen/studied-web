<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Student extends Model {



    use SoftDeletes;
    use BaseTrait;



    protected

        $table                                  = 'student';



    public function getUser() {

        return self::getThisToOne(self::$USER);

    }



    public function getRelations() {

        return self::getManyToMany(self::$RELATION, self::$STUDENT_RELATION, self::$STUDENT);

    }

    public function getRelationsByType($type) {

        return $this->getRelations()->where(self::$RELATION_TYPE, $type)->get();

    }



    public function hasCustomer() {

        return $this->getCustomer()->exists();

    }

    public function getCustomer() {

        return self::getThisToOne(self::$CUSTOMER);

    }





}
