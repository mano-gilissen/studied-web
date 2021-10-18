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



    public static function has_passed($datetime, $time = null) {

        $date_event                                         = strtotime(substr($datetime, 0, 10));
        $date_now                                           = strtotime($time ?? date(Format::$DATABASE_DATE, time()));

        echo($date_event);
        echo("\n");
        echo($date_now);
        dd('a');

        if ($date_event < $date_now) {

            return true;

        } else if ($date_event > $date_now) {

            return false;

        } else {

            $time_event                                     = strtotime($datetime);
            $time_now                                       = strtotime($time ?? date(Format::$DATABASE_TIME, time()));

            return $time_event < $time_now;
        }

    }



    public static function export_csv($columns, $rows, $filename = 'export.csv') {

        $headers = [
            "Content-type"                                  => "text/csv",
            "Content-Disposition"                           => "attachment; filename=" . $filename,
            "Pragma"                                        => "no-cache",
            "Cache-Control"                                 => "must-revalidate, post-check=0, pre-check=0",
            "Expires"                                       => "0"
        ];

        $callback = function() use ($columns, $rows ) {

            $file                                           = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($rows as $row) {

                fputcsv($file, $row);

            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }





}
