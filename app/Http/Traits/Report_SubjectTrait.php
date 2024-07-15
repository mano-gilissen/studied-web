<?php



namespace App\Http\Traits;

use App\Http\Support\Model;
use App\Models\Agreement;
use App\Models\Report_subject;



trait Report_SubjectTrait {



    public static function create($data, $key, $report) {

        $report_subject                                             = new Report_subject;

        $report_subject->{Model::$REPORT}                           = $report->{Model::$BASE_ID};

        if (array_key_exists($key . '_agreement', $data)) {

            $report_subject->{Model::$AGREEMENT}                    = $data[$key . '_agreement'];

        }

        $report_subject->{Model::$SUBJECT}                          = $data[$key];
        $report_subject->{Model::$REPORT_SUBJECT_DURATION}          = $data[$key . '_duration'];
        $report_subject->{Model::$REPORT_SUBJECT_VERSLAG}           = $data[$key . '_content_verslag'];

        $report_subject->save();
    }



    public static function getDurationReadable($report_subject) {

        if (!$report_subject || $report_subject->{Model::$REPORT_SUBJECT_DURATION} <= 0) {

            return false;

        }

        return ($report_subject->{Model::$REPORT_SUBJECT_DURATION} >= 60 && fmod($report_subject->{Model::$REPORT_SUBJECT_DURATION}, 60) == 0) ?

                ($report_subject->{Model::$REPORT_SUBJECT_DURATION} / 60) . ' uur'

                :

                ($report_subject->{Model::$REPORT_SUBJECT_DURATION}) . ' min';
    }



}
