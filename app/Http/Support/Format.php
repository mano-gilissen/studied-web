<?php



namespace App\Http\Support;



class Format {



    public static

            $DATETIME_LIST                      = "%e %b. %Y",
            $DATETIME_PROFILE                   = "%e %B %Y",
            $DATETIME_SINGLE                    = "%A %e %B";



    public static function datetime($datetime, $format) {

        return ucfirst($datetime->formatLocalized($format));

    }



}
