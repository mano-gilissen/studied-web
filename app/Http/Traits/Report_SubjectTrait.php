<?php



namespace App\Http\Traits;



trait Report_SubjectTrait {



    public static

        $REPORT_SUBJECT                             = 'report_subject',

        $REPORT_SUBJECT_DURATION                    = 'duration';



    public static function getDurationReadable($report_subject) {

        if (!$report_subject || $report_subject <= 0) {

            return false;

        }

        return ($report_subject->{self::$REPORT_SUBJECT_DURATION} % 1 == 0) ?

                    ($report_subject->{self::$REPORT_SUBJECT_DURATION}) . ' uur'

                    :

                    ($report_subject->{self::$REPORT_SUBJECT_DURATION} * 60) . ' min';
    }



}
