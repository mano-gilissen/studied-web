<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Student_relation extends ModelClass {



    use SoftDeletes;



    protected

        $table                                  = 'student_relation';



}
