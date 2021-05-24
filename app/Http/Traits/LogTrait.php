<?php



namespace App\Http\Traits;

use App\Models\Log;
use Auth;



trait LogTrait {



    use UserTrait;



    public static

        $LOG                                            = 'log',

        $LOG_ACTION                                     = 'action',
        $LOG_DATA                                       = 'data',

        $ACTION_LOGIN                                   = 'login';



    public static function create($action, $data = null) {

        $log                                            = new Log;

        $log->{self::$USER}                             = Auth::id();
        $log->{self::$LOG_ACTION}                       = $action;
        $log->{self::$LOG_DATA}                         = $data;

        $log->save();
    }



}
