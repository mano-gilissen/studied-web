<?php



namespace App\Http\Traits;

use App\Http\Support\Model;
use App\Models\Subject;



trait SubjectTrait {



    public static function getActivities() {

        return Subject::where(Model::$SUBJECT_CODE, 'LIKE', '%STD%')->get();

    }



}
