<?php



namespace App\Http\Traits;

use App\Models\Study_user;
use App\Http\Support\Model;



trait Study_UserTrait {



    public static function create($study, $agreement) {

        $study_user                                         = new Study_user;

        $study_user->{Model::$USER}                         = $agreement->{Model::$STUDENT};
        $study_user->{Model::$STUDY}                        = $study->{Model::$BASE_ID};

        $study_user->save();
    }



}
