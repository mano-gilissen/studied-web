<?php



namespace App\Http\Traits;

use App\Http\Support\Model;
use App\Models\Log;
use Auth;



trait LogTrait {





    public static function create($action, $data = null) {

        $log                                            = new Log;

        $log->{Model::$USER}                            = Auth::id();
        $log->{Model::$LOG_ACTION}                      = $action;
        $log->{Model::$LOG_DATA}                        = $data;

        $log->save();
    }





}
