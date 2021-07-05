<?php



namespace App\Http\Support;



class Format {



    public static function datetime($datetime) {

        return ucfirst($datetime->formatLocalized("%A %e %B"));

    }



}
