<?php



namespace App\Http\Traits;



trait ReportTrait {



    public static

        $REPORT                                     = 'report',

        $REPORT_CONTENT_VERSLAG                     = 'content_verslag',
        $REPORT_CONTENT_VOLGENDE_LES                = 'content_volgende_les',
        $REPORT_CONTENT_UITDAGINGEN                 = 'content_uitdagingen',
        $REPORT_CONTENT_VOORTGANG                   = 'content_voortgang',
        $REPORT_TRIAL_SUCCESS                       = 'trial_succes';



    public static function getDurationTotal($report) {

        $report_subjects                            = $report->getReport_Subjects;

        $duration_total                             = 0.0;

        foreach($report_subjects as $report_subject) {

            $duration_total                         += $report_subject->duration;

        }

        return $duration_total;
    }

    public static function getDurationDots($report) {

        $duration_total                             = self::getDurationTotal($report);

        return (int) ($duration_total / .25);
    }



}
