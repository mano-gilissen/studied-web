<?php



namespace App\Http\Traits;

use App\Http\Support\Func;
use App\Http\Support\Model;
use App\Models\Report;



trait ReportTrait {





    public static function create(array $data, &$study) {



        foreach ($study->getParticipants_User as $user) {

            $report                                                         = new Report;

            $prefix                                                         = 'user_' . $user->id . '_';

            $report->{Model::$STUDY}                                        = $study->{Model::$BASE_ID};
            $report->{Model::$USER}                                         = $user->id;

            $report->{Model::$REPORT_CONTENT_VOLGENDE_LES}                  = $data[$prefix . Model::$REPORT_CONTENT_VOLGENDE_LES];
            $report->{Model::$REPORT_CONTENT_UITDAGINGEN}                   = $data[$prefix . Model::$REPORT_CONTENT_UITDAGINGEN];
            $report->{Model::$REPORT_CONTENT_VOORTGANG}                     = $data[$prefix . Model::$REPORT_CONTENT_VOORTGANG];

            $report->{Model::$REPORT_START}                                 = substr($study->start, 0, 10) . ' ' . $data[Model::$REPORT_START] . ':00';
            $report->{Model::$REPORT_END}                                   = substr($study->end, 0, 10) . ' ' . $data[Model::$REPORT_END] . ':00';



            $report->save();



            foreach ($data as $key => $value) {

                if (Func::contains($key, '_' . $prefix . Model::$SUBJECT) &&
                   !Func::contains($key, Model::$AGREEMENT) &&
                   !Func::contains($key, Model::$REPORT_SUBJECT_DURATION) &&
                   !Func::contains($key, Model::$REPORT_SUBJECT_VERSLAG) &&
                    strlen($data[$key]) > 0) {

                    Report_SubjectTrait::create($data, $key, $report);

                }

                if (Func::contains($key, $prefix . Model::$STUDY_TRIAL)) {

                    self::trial($data[$key], $study, $user, $report);

                }
            }

        }



        return true;
    }



    public static function trial($result, $study, $user, $report) {

        $trail_success                                                      = $result == 2; // TODO: REPLACE 2 WITH SWITCH.YES CONST

        $report->{Model::$REPORT_TRIAL_SUCCESS}                             = $trail_success;
        $report->save();

        if ($trail_success) {

            AgreementTrait::approve($study, $user);

        } else {

            AgreementTrait::reject($study, $user);

        }
    }





    public static function getReportSubject($report, $primary = true) {

        $report_subjects                                                    = $report->getReport_Subjects;
        $study                                                              = $report->getStudy;

        foreach ($report_subjects as $report_subject) {

            if (($primary && StudyTrait::getSubject($study)->{Model::$BASE_ID} == $report_subject->{Model::$SUBJECT}) ||
               (!$primary && StudyTrait::getSubject($study)->{Model::$BASE_ID} != $report_subject->{Model::$SUBJECT})) {

                return $report_subject;

            }
        }

        return null;
    }





    public static function getVerslagText($report) {

        $report_subjects                                                    = $report->getReport_Subjects;

        if (count($report_subjects) == 1) {

            return $report_subjects[0]->{Model::$REPORT_SUBJECT_VERSLAG};

        } else {

            $text                                                           = "";

            foreach ($report_subjects as $report_subject) {

                $text                                                       .= $report_subject->{Model::$REPORT_SUBJECT_VERSLAG} . " ";

            }

            return $text;
        }
    }



    public static function getDurationTotal($report) {

        $report_subjects                                                    = $report->getReport_Subjects;

        $duration_total                                                     = 0;

        foreach($report_subjects as $report_subject) {

            $duration_total                                                += $report_subject->{Model::$REPORT_SUBJECT_DURATION};

        }

        return $duration_total;
    }

    public static function getDurationDots_Total($report) {

        $duration_total                                                     = self::getDurationTotal($report);

        return (int) ($duration_total / 15);
    }





}
