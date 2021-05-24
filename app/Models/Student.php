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



    public function getRelations() {

        return self::getManyToMany(self::$RELATION, self::$STUDENT_RELATION, self::$STUDENT);

    }



}
