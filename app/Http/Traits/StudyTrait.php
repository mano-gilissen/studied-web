<?php



namespace App\Http\Traits;

use App\Http\Controllers\StudyController;
use App\Http\Support\Format;
use App\Http\Support\Key;
use App\Http\Support\Color;
use App\Http\Support\Mail;
use App\Http\Support\Model;
use App\Http\Support\Func;
use App\Models\Address;
use App\Models\Agreement;
use App\Models\Report;
use App\Models\Study;
use App\Models\User;
use App\Rules\DateBeforeEndAgreement;
use Auth;
use Illuminate\Support\Facades\Validator;



trait StudyTrait {





    public static

        $STATUS_CREATED                                             = 0,
        $STATUS_PLANNED                                             = 1,
        $STATUS_ACTIVE                                              = 2,
        $STATUS_FINISHED                                            = 3,
        $STATUS_REPORTED                                            = 4,
        $STATUS_CANCELLED                                           = 5,
        $STATUS_ABSENT                                              = 6;





    public static function create(array $data, &$study) {

        self::validate($data);

        $study                                                  = new Study;

        $study->{Model::$BASE_KEY}                              = Func::generate_key(Model::$STUDY);

        $study->{Model::$STUDY_START}                           = $data['date'] . ' ' . $data[Model::$STUDY_START] . ':00';
        $study->{Model::$STUDY_END}                             = $data['date'] . ' ' . $data[Model::$STUDY_END] . ':00';

        $study->{Model::$STUDY_REMARK}                          = $data[Model::$STUDY_REMARK];
        $study->{Model::$STUDY_STATUS}                          = self::$STATUS_PLANNED;



        $study->save();



        self::create_set_agreements($study, $data);

        self::create_set_location($study, $data);

        self::create_set_service($study, $data);



        $study->save();



        foreach ($study->getParticipants_User as $user) {

            if (UserTrait::isActivated($user)) {

                Mail::studyPlanned_forStudent($study, $user);

            }
        }

        if ($study->{Model::$STUDY_HOST_USER} != Auth::id()) {

            Mail::studyPlanned_forEmployee($study);

        }



        return $study;
    }



    public static function create_set_agreements(&$study, $data) {

        $agreements                                                 = [];

        foreach ($data as $key => $value) {

            if (Func::contains($key, '_' . Model::$AGREEMENT)) {

                $agreement                                          = Agreement::find($value);

                if (!$agreement) {

                    continue;

                }

                if (AgreementTrait::planNowTrial($agreement)) {

                    $study->{Model::$STUDY_TRIAL}                   = true;
                    $agreement->{Model::$AGREEMENT_STATUS}          = AgreementTrait::$STATUS_TRIAL;
                    $agreement->save();
                }

                $study->{Model::$STUDY_HOST_USER}                   = $agreement->{Model::$EMPLOYEE};
                $study->{Model::$STUDY_SUBJECT_TEXT}                = $agreement->getSubject->{Model::$SUBJECT_NAME};

                array_push($agreements, $agreement);
            }
        }

        foreach ($agreements as $agreement) {

            Study_UserTrait::create($study, $agreement);

        }
    }



    public static function create_set_location(&$study, $data) {

        if (strlen($data[Key::AUTOCOMPLETE_ID . Model::$LOCATION]) > 0) {

            if ($data[Key::AUTOCOMPLETE_ID . Model::$LOCATION] == Key::CURRENT_ID) {

                return;

            }

            if ($data[Key::AUTOCOMPLETE_ID . Model::$LOCATION] == StudyController::$STUDY_PLAN_LOCATION_HOST) {

                $employee                                           = $study->getHost_User;

                if ($employee) {

                    $study->{Model::$STUDY_LOCATION_TEXT}           = __('Thuis bij ') . PersonTrait::getFullName($employee->getPerson);

                    $study->{Model::$ADDRESS}                       = $employee->getPerson->{Model::$ADDRESS};
                }

            } else {

                $address                                            = Address::find($data[Key::AUTOCOMPLETE_ID . Model::$LOCATION]);

                if ($address) {

                    if ($address->getLocation) {

                        $study->{Model::$STUDY_LOCATION_TEXT}       = $address->getLocation->{Model::$LOCATION_NAME};

                    } else if ($address->getPerson) {

                        $study->{Model::$STUDY_LOCATION_TEXT}       = __('Thuis bij ') . PersonTrait::getFullName($address->getPerson);

                    }

                    $study->{Model::$ADDRESS}                       = $data[Key::AUTOCOMPLETE_ID . Model::$LOCATION];
                }
            }

        } else {

            $study->{Model::$STUDY_LOCATION_TEXT}                   = $data[Model::$LOCATION];
            $study->{Model::$ADDRESS}                               = null;

        }

        if (array_key_exists(Model::$STUDY_LINK, $data)) {

            $study->{Model::$STUDY_LINK}                            = $data[Model::$STUDY_LINK];

        }
    }



    public static function create_set_service(&$study, $data) {

        $study->{Model::$SERVICE}                                   = $study->getAgreements->first()->{Model::$SERVICE};

    }





    public static function update(array $data, &$study) {

        self::validate($data);

        $study->{Model::$STUDY_START}                               = $data['date'] . ' ' . $data[Model::$STUDY_START] . ':00';
        $study->{Model::$STUDY_END}                                 = $data['date'] . ' ' . $data[Model::$STUDY_END] . ':00';

        $study->{Model::$STUDY_REMARK}                              = $data[Model::$STUDY_REMARK];
        $study->{Model::$STUDY_STATUS}                              = $data[Key::AUTOCOMPLETE_ID . Model::$STUDY_STATUS];



        self::create_set_location($study, $data);



        $study->save();



        // TODO: PUBLIC SERVICES (COLLEGE/TRAININGEN)



        // TODO: REMOVE TEMPORARY CHECK, REPLACE WITH EMAILS FOR PUBLIC SERVICES (COLLEGE/TRAININGEN)
        if (self::hasAgreements($study)) {

            foreach ($study->getParticipants_User as $user) {

                if (UserTrait::isActivated($user)) {

                    Mail::studyEdited_forStudent($study, $user);

                }
            }

            if ($study->{Model::$STUDY_HOST_USER} != Auth::id()) {

                Mail::studyEdited_forEmployee($study);

            }
        }



        return $study;
    }





    public static function validate(array $data) {

        $rules                                                      = [];

        $rules['date']                                              = ['required'];
        $rules[Model::$STUDY_START]                                 = ['required'];
        $rules[Model::$STUDY_END]                                   = ['required'];
        $rules[Model::$LOCATION]                                    = ['required_if:link,""'];
        $rules[Model::$STUDY_LINK]                                  = ['required_if:location,""'];

        foreach ($data as $key => $value) {

            if (Func::contains($key, '_' . Model::$AGREEMENT)) {

                $rules[$key]                                        = [new DateBeforeEndAgreement(array_key_exists('date', $data) ? $data['date'] : null)];

            }
        }

        $validator                                                  = Validator::make($data, $rules, BaseTrait::getValidationMessages());

        $validator->validate();
    }





    public static function getParticipants_Person($study) {

        $persons                                                    = [];

        $users                                                      = $study->getParticipants_User()->get();
        $participants                                               = $study->getParticipants_Participant()->get();

        foreach ($users as $user) {

            array_push($persons, $user->getPerson);

        }

        foreach ($participants as $participant) {

            array_push($persons, $participant->getPerson);

        }

        return $persons;
    }



    public static function countParticipants($study) {

        $total                                                      = 0;

        $total                                                     += $study->getParticipants_User()->count();
        $total                                                     += $study->getParticipants_Participant()->count();

        return $total;
    }



    public static function getDuration($study, $participant = null) {

        switch ($study->{Model::$STUDY_STATUS}) {

            case StudyTrait::$STATUS_REPORTED:

                if ($participant) {

                    return ReportTrait::getDurationTotal($study->getReport($participant));

                } else {

                    $durationMax                                    = 0;

                    foreach ($study->getReports as $report) {

                        if (ReportTrait::getDurationTotal($report) > $durationMax) {

                            $durationMax = ReportTrait::getDurationTotal($report);

                        }
                    }

                    return $durationMax / 60.0;
                }

            default:

                return (strtotime($study->{Model::$STUDY_END}) - strtotime($study->{Model::$STUDY_START})) / 3600.0;
        }
    }



    public static function getSubject($study) {

        return $study->getAgreements[0]->getSubject;

    }



    public static function getBanner($study) {

        return self::hasAgreements($study) ? (self::getSubject($study)->{Model::$SUBJECT_BANNER} . '.png') : "ALG_3.png";

    }



    public static function getStatus($study) {

        switch ($study->status) {

            case self::$STATUS_PLANNED:                             return self::hasStarted($study) ? (self::hasFinished($study) ? self::$STATUS_FINISHED : self::$STATUS_ACTIVE) : self::$STATUS_PLANNED;
            default:                                                return $study->status;
        }
    }



    public static function getPlan($study, $participant) {

        foreach($study->getAgreements as $agreement) {

            if ($agreement->{Model::$STUDENT} == $participant->{Model::$BASE_ID}) {

                return $agreement->{Model::$AGREEMENT_PLAN};

            }
        }

        return null;
    }



    public static function getParticipantsText($study) {

        $participants                                               = StudyTrait::getParticipants_Person($study);

        switch(count($participants)) {
            case 0:                                                 return __("Geen deelnemers");
            case 1:                                                 return PersonTrait::getFullName($participants[0]);
            case 2:                                                 return $participants[0]->{Model::$PERSON_FIRST_NAME} . __(" en ") . $participants[1]->{Model::$PERSON_FIRST_NAME};
            case 3:                                                 return $participants[0]->{Model::$PERSON_FIRST_NAME} . ", " . $participants[1]->{Model::$PERSON_FIRST_NAME} . __(" en ") . $participants[2]->{Model::$PERSON_FIRST_NAME};
            default:                                                return count($participants) . __(" deelnemers");
        }
    }



    public static function getTimeText($study, $tot = false) {

        return $study->start != null && $study->end != null ? Format::datetime(self::getStartTime($study), Format::$TIME_SINGLE) . ($tot ? __(' tot ') : ' - ') . Format::datetime(self::getEndTime($study), Format::$TIME_SINGLE) : __('Onbekend');

    }



    public static function getStartTime($study) {

        if (self::hasReporting($study) && self::isReported($study)) {

            $reports                                                = $study->getReports;

            if ($reports->count() > 0) {

                return $study->getReports[0]->{Model::$REPORT_START};

            } else {

                return $study->{Model::$STUDY_START};

            }

        } else {

            return $study->{Model::$STUDY_START};

        }
    }



    public static function getEndTime($study) {

        if (self::hasReporting($study) && self::isReported($study)) {

            $reports                                                = $study->getReports;

            if ($reports->count() > 0) {

                return $study->getReports[0]->{Model::$REPORT_END};

            } else {

                return $study->{Model::$STUDY_END};

            }

        } else {

            return $study->{Model::$STUDY_END};

        }
    }



    public static function getStatusText($status) {

        switch ($status) {

            case self::$STATUS_CREATED:                             return __("Aangemaakt");
            case self::$STATUS_PLANNED:                             return __("Ingepland");
            case self::$STATUS_ACTIVE:                              return __("Bezig");
            case self::$STATUS_FINISHED:                            return __("Afgelopen");
            case self::$STATUS_REPORTED:                            return __("Gerapporteerd");
            case self::$STATUS_CANCELLED:                           return __("Geannuleerd");
            case self::$STATUS_ABSENT:                              return __("Verzuimd");
            default:                                                return __('Onbekend');
        }
    }



    public static function getStatusColor($status) {

        switch ($status) {

            case self::$STATUS_CANCELLED:
            case self::$STATUS_ABSENT:                              return Color::RED;
            case self::$STATUS_REPORTED:                            return Color::GREEN;
            case self::$STATUS_ACTIVE:
            case self::$STATUS_FINISHED:                            return Color::ORANGE;
            case self::$STATUS_PLANNED:
            case self::$STATUS_CREATED:
            default:                                                return Color::GREY_80;
        }
    }



    public static function getStatusTextColor($study) {

        switch ($study->status) {

            case self::$STATUS_CREATED:
            case self::$STATUS_CANCELLED:
            case self::$STATUS_ACTIVE:
            case self::$STATUS_REPORTED:
            case self::$STATUS_ABSENT:
            case self::$STATUS_PLANNED:
            case self::$STATUS_FINISHED:
            default:                                                return Color::WHITE;
        }
    }



    public static function getStatusFilterData() {

        return [
            StudyTrait::$STATUS_CREATED                             => StudyTrait::getStatusText(StudyTrait::$STATUS_CREATED),
            StudyTrait::$STATUS_PLANNED                             => StudyTrait::getStatusText(StudyTrait::$STATUS_PLANNED),
            StudyTrait::$STATUS_ACTIVE                              => StudyTrait::getStatusText(StudyTrait::$STATUS_ACTIVE),
            StudyTrait::$STATUS_FINISHED                            => StudyTrait::getStatusText(StudyTrait::$STATUS_FINISHED),
            StudyTrait::$STATUS_REPORTED                            => StudyTrait::getStatusText(StudyTrait::$STATUS_REPORTED),
            StudyTrait::$STATUS_CANCELLED                           => StudyTrait::getStatusText(StudyTrait::$STATUS_CANCELLED),
            StudyTrait::$STATUS_ABSENT                              => StudyTrait::getStatusText(StudyTrait::$STATUS_ABSENT)
        ];
    }



    public static function hasStarted($study) {

        return Func::has_passed($study->start);

    }



    public static function hasFinished($study) {

        return Func::has_passed($study->end);

    }



    public static function hasReporting($study) {

        return true; //!in_array($study->{Model::$SERVICE}, [ServiceTrait::$ID_COLLEGE, ServiceTrait::$ID_TRAINING]);

    }



    public static function hasReport($study, $user) {

        return Report::where(Model::$STUDY, $study->{Model::$BASE_ID})->where(Model::$USER, $user->id)->exists();

    }



    public static function hasGroupReporting($study) {

        return self::hasReporting($study) && $study->getParticipants_User->count() > 1;

    }



    public static function hasAgreements($study) {

        return true; //!in_array($study->{Model::$SERVICE}, [ServiceTrait::$ID_COLLEGE, ServiceTrait::$ID_TRAINING]);

    }



    public static function hasLink($study) {

        return strlen($study->link) > 0;

    }



    public static function isReported($study) {

        foreach($study->getParticipants_User as $user) {

            if (!self::hasReport($study, $user)) {

                return false;

            }
        }

        return true;
    }



    public static function isTrial($study) {

        return $study->{Model::$STUDY_TRIAL};

    }



    public static function canEdit($study, $user = null) {

        if (!$user) {

            $user                                                   = Auth::user();

        }

        return $user->role <= RoleTrait::$ID_MANAGEMENT || $user->id == $study->{Model::$STUDY_HOST_USER};
    }



    public static function canReport($study, $user = null) {

        if (!$user) {

            $user                                                   = Auth::user();

        }

        return ($user->role <= RoleTrait::$ID_MANAGEMENT || $user->id == $study->{Model::$STUDY_HOST_USER}) && self::hasReporting($study);
    }



    public static function canReport_Edit($study, $user = null) {

        if (!$user) {

            $user                                                   = Auth::user();

        }

        return $user->role <= RoleTrait::$ID_MANAGEMENT && self::hasReporting($study);
    }



    public static function canDelete($study, $user = null) {

        if (!$user) {

            $user                                                   = Auth::user();

        }

        return $user->role <= RoleTrait::$ID_MANAGEMENT;
    }





}
