<?php

namespace App\Http\Support;

use App\Models\Evaluation;
use App\Models\Study;
use DateTime;
use DateTimeZone;



class Func {



    public static

            $DATETIME_LIST                      = "%e %b. %Y",
            $DATETIME_AGREEMENT                 = "%e %B, %Y",
            $DATETIME_PROFILE                   = "%e %B %Y",
            $DATETIME_SINGLE                    = "%A %e %B";



    public static function generate_key($application = 'misc') {

        $key = rand(100000, 999999);

        switch ($application) {

            case Model::$STUDY:
                return Study::where(Model::$BASE_KEY, $key)->exists() ? self::generate_key($application) : $key;

            case Model::$EVALUATION:
                return Evaluation::where(Model::$BASE_KEY, $key)->exists() ? self::generate_key($application) : $key;

            default:
                return $key;
        }
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

        $callback = function() use ($columns, $rows) {

            $file                                           = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($rows as $row) {

                fputcsv($file, $row);

            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }




    public static function generate_calendar_invite(
        $uid,
        $summary,
        $description,
        $location,
        $start,
        $end,
        $organizerName,
        $organizerEmail,
        $attendees = []
    ) {
        $format = 'Ymd\THis\Z';
        $dtStart = $start->setTimezone(new DateTimeZone('UTC'))->format($format);
        $dtEnd = $end->setTimezone(new DateTimeZone('UTC'))->format($format);
        $dtStamp = (new DateTime('now', new DateTimeZone('UTC')))->format($format);

        $attendeeLines = '';
        foreach ($attendees as $attendee) {
            $attendeeLines .= 'ATTENDEE;CN=' . $attendee['name'] . ';RSVP=TRUE:mailto:' . $attendee['email'] . "\r\n";
        }

        $ics = "BEGIN:VCALENDAR\r\n";
        $ics .= "VERSION:2.0\r\n";
        $ics .= "PRODID:-//YourApp//EN\r\n";
        $ics .= "CALSCALE:GREGORIAN\r\n";
        $ics .= "METHOD:REQUEST\r\n";
        $ics .= "BEGIN:VEVENT\r\n";
        $ics .= "UID:$uid\r\n";
        $ics .= "DTSTART:$dtStart\r\n";
        $ics .= "DTEND:$dtEnd\r\n";
        $ics .= "DTSTAMP:$dtStamp\r\n";
        $ics .= "SUMMARY:$summary\r\n";
        $ics .= "DESCRIPTION:$description\r\n";
        $ics .= "LOCATION:$location\r\n";
        $ics .= "ORGANIZER;CN=$organizerName:mailto:info@studied.app\r\n";
        $ics .= $attendeeLines;
        $ics .= "END:VEVENT\r\n";
        $ics .= "END:VCALENDAR\r\n";

        return $ics;
    }





}
