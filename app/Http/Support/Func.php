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



}
