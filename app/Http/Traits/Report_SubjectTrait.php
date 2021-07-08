<?php



namespace App\Http\Traits;



trait Report_SubjectTrait {



    public static

        $REPORT_SUBJECT                             = 'report_subject',

        $REPORT_SUBJECT_DURATION                    = 'duration';



    public static function getDurationReadable($report_subject) {

        if (!$report_subject || $report_subject->{self::$REPORT_SUBJECT_DURATION} <= 0) {

            return false;

        }

        return $report_subject->{self::$REPORT_SUBJECT_DURATION} % 1;

        return ($report_subject->{self::$REPORT_SUBJECT_DURATION} >= 1.0 && $report_subject->{self::$REPORT_SUBJECT_DURATION} % 1 == 0) ?

                ((int) ($report_subject->{self::$REPORT_SUBJECT_DURATION})) . ' uur'

                    :

                ((int) ($report_subject->{self::$REPORT_SUBJECT_DURATION} * 60.0)) . ' min';
    }



    public static function getDurationDots($report_subject) {

        return (int) ($report_subject->{self::$REPORT_SUBJECT_DURATION} / .25);

    }



}
