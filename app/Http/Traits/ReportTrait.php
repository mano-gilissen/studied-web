<?php



namespace App\Http\Traits;



use App\Http\Support\Model;



trait ReportTrait {





    public static function getDurationTotal($report) {

        $report_subjects                            = $report->getReport_Subjects;

        $duration_total                             = 0.0;

        foreach($report_subjects as $report_subject) {

            $duration_total                         += $report_subject->{Model::$REPORT_SUBJECT_DURATION};

        }

        return $duration_total;
    }

    public static function getDurationDots_Total($report) {

        $duration_total                             = self::getDurationTotal($report);

        return (int) ($duration_total / .25);
    }



}
