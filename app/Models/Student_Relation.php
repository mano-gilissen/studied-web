<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Student_Relation extends Model {



    use SoftDeletes;



    protected

        $table                                  = 'student_relation';



}
