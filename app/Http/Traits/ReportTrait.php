<?php



namespace App\Http\Traits;

use App\Http\Support\Func;
use App\Http\Support\Model;
use App\Models\Report;
use Illuminate\Support\Facades\Validator;



trait ReportTrait {





    public static function create(array $data, &$study) {



        self::validate($data);



        foreach ($study->getParticipants_User as $user) {

            $report                                                         = new Report;

            $prefix                                                         = 'user_' . $user->id . '_';

            $report->{Model::$STUDY}                                        = $study->{Model::$BASE_ID};
            $report->{Model::$USER}                                         = $user->id;

            $report->{Model::$REPORT_CONTENT_VOLGENDE_LES}                  = $data[$prefix . Model::$REPORT_CONTENT_VOLGENDE_LES];
            $report->{Model::$REPORT_CONTENT_UITDAGINGEN}                   = $data[$prefix . Model::$REPORT_CONTENT_UITDAGINGEN];
            $report->{Model::$REPORT_CONTENT_VOORTGANG}                     = $data[$prefix . Model::$REPORT_CONTENT_VOORTGANG];

            $start                                                          = substr($study->start, 0, 10) . ' ' . $data[Model::$REPORT_START] . ':00';
            $end                                                            = substr($study->end, 0, 10) . ' ' . $data[Model::$REPORT_END] . ':00';

            $report->{Model::$REPORT_START}                                 = $start;
            $report->{Model::$REPORT_END}                                   = $end;

            $study->{Model::$STUDY_START}                                   = $start;
            $study->{Model::$STUDY_END}                                     = $end;



            $report->save();
            $study->save();



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



    public static function update(array $data, &$study) {



        self::validate($data);



        foreach ($study->getParticipants_User as $user) {

            $report                                                         = $study->getReport($user);

            if (!$report) {

                $report                                                     = new Report;
                $report->{Model::$STUDY}                                    = $study->{Model::$BASE_ID};
                $report->{Model::$USER}                                     = $user->id;
            }

            $prefix                                                         = 'user_' . $user->id . '_';

            $report->{Model::$REPORT_CONTENT_VOLGENDE_LES}                  = $data[$prefix . Model::$REPORT_CONTENT_VOLGENDE_LES];
            $report->{Model::$REPORT_CONTENT_UITDAGINGEN}                   = $data[$prefix . Model::$REPORT_CONTENT_UITDAGINGEN];
            $report->{Model::$REPORT_CONTENT_VOORTGANG}                     = $data[$prefix . Model::$REPORT_CONTENT_VOORTGANG];

            $start                                                          = substr($study->start, 0, 10) . ' ' . $data[Model::$REPORT_START] . ':00';
            $end                                                            = substr($study->end, 0, 10) . ' ' . $data[Model::$REPORT_END] . ':00';

            $report->{Model::$REPORT_START}                                 = $start;
            $report->{Model::$REPORT_END}                                   = $end;

            $study->{Model::$STUDY_START}                                   = $start;
            $study->{Model::$STUDY_END}                                     = $end;



            $report->save();
            $study->save();



            foreach ($report->getReport_Subjects as $report_Subject) {

                $report_Subject->delete();

            }

            foreach ($data as $key => $value) {

                if (Func::contains($key, '_' . $prefix . Model::$SUBJECT) &&
                    !Func::contains($key, Model::$AGREEMENT) &&
                    !Func::contains($key, Model::$REPORT_SUBJECT_DURATION) &&
                    !Func::contains($key, Model::$REPORT_SUBJECT_VERSLAG) &&
                    strlen($data[$key]) > 0) {

                    Report_SubjectTrait::create($data, $key, $report);

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



    public static function validate(array $data) {

        $messages                                                           = [
            'required'                                                      => 'Dit veld is verplicht.',
            'max'                                                           => 'Gebruik maximaal 1000 karakters.'
        ];



        $rules                                                              = [];

        foreach ($data as $key => $value) {

            if (Func::contains($key, [Model::$REPORT_CONTENT_VOORTGANG, Model::$REPORT_CONTENT_UITDAGINGEN, Model::$REPORT_CONTENT_VOLGENDE_LES])) {

                $rules[$key]                                                = ['required', 'max:999'];

            }

            if (Func::contains($key, Model::$REPORT_SUBJECT_VERSLAG)) {

                // TODO: FINISH
                // Only add to rules if field belongs to primary subject or report for this user has secondary subject

            }
        }



        $validator                                                          = Validator::make($data, $rules, $messages);

        $validator->validate();
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





}
