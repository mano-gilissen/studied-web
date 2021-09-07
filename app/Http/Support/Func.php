<?php



namespace App\Http\Support;



class Func {



    public static

            $DATETIME_LIST                      = "%e %b. %Y",
            $DATETIME_AGREEMENT                 = "%e %B, %Y",
            $DATETIME_PROFILE                   = "%e %B %Y",
            $DATETIME_SINGLE                    = "%A %e %B";



    public static function generate_key() {

        return rand(100000, 999999);

    }



    public static function generate_secret($length = 10) {

        return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);

    }



    public static function contains($haystack, $needle) {

        if(!is_array($needle)) {

            $needle                                         = array($needle);

        }

        foreach($needle as $query) {

            if(strpos($haystack, $query) !== false) {

                return true;

            }
        }

        return false;
    }



    public static function has_passed($datetime) {

        $date_event                                         = strtotime(substr($datetime, 0, 10));
        $date_now                                           = strtotime(date(Format::$DATABASE_DATE, time()));

        if ($date_event < $date_now) {

            return true;

        } else if ($date_event > $date_now) {

            return false;

        } else {

            $time_event                                     = strtotime($datetime);
            $time_now                                       = strtotime(date(Format::$DATABASE_TIME, time()));

            return $time_event < $time_now;
        }

    }



}
