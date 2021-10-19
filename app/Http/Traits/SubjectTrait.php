<?php



namespace App\Http\Traits;

use App\Http\Support\Model;
use App\Models\Subject;



trait SubjectTrait {



    public static function getActivities() {

        return Subject::whereIn(Model::$SUBJECT_CODE, 'LIKE', '%S-%')->get();

    }



}
