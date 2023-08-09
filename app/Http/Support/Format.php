<?php



namespace App\Http\Support;



class Format {



    public static

            $DATABASE_DATETIME                  = "Y-m-d H:i:s",
            $DATABASE_DATE                      = "Y-m-d",
            $DATABASE_TIME                      = "H:i",

            $DATETIME_LIST                      = "%e %b. %Y",
            $DATETIME_AGREEMENT                 = "%e %B, %Y",
            $DATETIME_EMAIL                     = "%e %B",
            $DATETIME_ARTICLE                   = "%e %B %Y",
            $DATETIME_PROFILE                   = "%e %B %Y",
            $DATETIME_SINGLE                    = "%A %e %B",
            $DATETIME_FORM                      = "%Y-%m-%d",
            $DATETIME_EXPORT                    = "%d-%m-%Y",

            $DATE_SINGLE                        = "dmy",
            $TIME_SINGLE                        = "%H:%M";



    public static function datetime($datetime, $format) {

        return ucfirst($datetime->formatLocalized($format));

    }



    public static function encode($data) {

        return $data ? json_encode($data) : '{}';

    }



}
