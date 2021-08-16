<?php



namespace App\Http\Traits;

use App\Http\Support\Model;
use App\Models\Report_subject;



trait Report_SubjectTrait {



    public static function create($data, $key, $report) {

        $report_subject                                             = new Report_subject;

        $report_subject->{Model::$REPORT}                           = $report->{Model::$BASE_ID};

        $report_subject->{Model::$SUBJECT}                          = $data[$key];
        $report_subject->{Model::$REPORT_SUBJECT_DURATION}          = $data[$key . '_duration'];
        $report_subject->{Model::$REPORT_SUBJECT_VERSLAG}           = $data[$key . '_verslag'];

        $report_subject->save();
    }



    public static function getDurationReadable($report_subject) {

        if (!$report_subject || $report_subject->{Model::$REPORT_SUBJECT_DURATION} <= 0) {

            return false;

        }

        return ($report_subject->{Model::$REPORT_SUBJECT_DURATION} >= 1.0 && fmod($report_subject->{Model::$REPORT_SUBJECT_DURATION}, 1) == 0) ?

                ($report_subject->{Model::$REPORT_SUBJECT_DURATION}) . ' uur'

                :

                ($report_subject->{Model::$REPORT_SUBJECT_DURATION} * 60) . ' min';
    }



    public static function getDurationDots($report_subject) {

        return (int) ($report_subject->{Model::$REPORT_SUBJECT_DURATION} / .25);

    }



}
