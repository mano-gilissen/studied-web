<?php



namespace App\Http\Traits;



use App\Http\Support\Model;
use App\Models\Report;


trait ReportTrait {





    public static function create(array $data, &$study) {

        $report                                              = new Report;

        dd($data);


 /*
        $study->{Model::$STUDY_START}                       = $data['date'] . ' ' . $data[Model::$STUDY_START] . ':00';
        $study->{Model::$STUDY_END}                         = $data['date'] . ' ' . $data[Model::$STUDY_END] . ':00';

        $study->{Model::$STUDY_STATUS}                      = self::$STATUS_PLANNED;
        $study->{Model::$STUDY_LOCATION_DEFINED}            = $data[Key::AUTOCOMPLETE_ID . Model::$LOCATION]; // TODO: STUDY LOCATION TEXT IF NO DEFINED



        $agreements                                         = [];

        foreach ($data as $key => $value) {

            if (Func::contains($key, '_' . Model::$AGREEMENT)) {

                $agreement                                  = Agreement::find($value);

                if (!$agreement) {

                    continue;

                }

                $study->{Model::$STUDY_HOST_USER}           = $agreement->{Model::$EMPLOYEE};
                $study->{Model::$STUDY_SUBJECT_DEFINED}     = $agreement->{Model::$SUBJECT};

                array_push($agreements, $agreement);
            }
        }

        $study->{Model::$SERVICE}                           = count($agreements) > 1 ? ServiceTrait::$ID_GROEPSLES : ServiceTrait::$ID_PRIVELES;



        $study->save();



        foreach ($agreements as $agreement) {

            Study_UserTrait::create($study, $agreement);

        }

        */

        return $report;
    }





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
