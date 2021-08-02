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



    public static function contains($haystack, $needle) {

        return strpos($haystack, $needle) !== false;

    }



    public static function has_passed($date, $time) {

        $date_event                                         = strtotime(substr($date, 0, 10));
        $date_now                                           = strtotime(date('Y-m-d', time()));

        if ($date_event < $date_now) {

            return true;

        } else if ($date_event > $date_now) {

            return false;

        } else {

            $time_event                                     = strtotime($time);
            $time_now                                       = strtotime(date('H:i:s', time()));

            return $time_event < $time_now;
        }

    }



}
