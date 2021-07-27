<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Student extends ModelClass {



    use SoftDeletes;
    use BaseTrait;



    protected

        $table                                  = 'student';



    public function getUser() {

        return self::getThisToOne(Model::$USER);

    }



    public function getRelations() {

        return self::getManyToMany(Model::$RELATION, Model::$STUDENT_RELATION, Model::$STUDENT);

    }

    public function getRelationsByType($type) {

        return $this->getRelations()->where(Model::$RELATION_TYPE, $type)->get();

    }



    public function getCustomer() {

        return self::getThisToOne(Model::$CUSTOMER);

    }





}
