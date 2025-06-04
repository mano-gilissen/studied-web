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
use Illuminate\Validation\Rule;



trait StudyTrait {





    public static

        $STATUS_CREATED                                             = 0,
        $STATUS_PLANNED                                             = 1,
        $STATUS_ACTIVE                                              = 2,
        $STATUS_FINISHED                                            = 3,
        $STATUS_REPORTED                                            = 4,
        $STATUS_CANCELLED                                           = 5,
        $STATUS_ABSENT                                              = 6,

        $REASON_CANCEL_CUSTOMER                                     = 1,
        $REASON_CANCEL_STUDIED                                      = 2;





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

        if ($study->{Model::$STUDY_STATUS} == self::$STATUS_CANCELLED) {

            $study->{Model::$STUDY_REASON_CANCEL}                   = $data[Key::AUTOCOMPLETE_ID . Model::$STUDY_REASON_CANCEL];
            $study->{Model::$STUDY_EXPLANATION_CANCEL}              = $data[Model::$STUDY_EXPLANATION_CANCEL];

        } else {

            $study->{Model::$STUDY_REASON_CANCEL}                   = 1;
            $study->{Model::$STUDY_EXPLANATION_CANCEL}              = null;

        }



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
        $rules[Model::$STUDY_END]                                   = ['required', Rule::notIn(['00:00', $data[Model::$STUDY_START]])];
        $rules[Model::$STUDY_LINK]                                  = ['required_if:location,""'];
        $rules[Model::$LOCATION]                                    = ['required_if:link,""'];

        if (array_key_exists(Model::$STUDY_STATUS, $data) && ($data[Key::AUTOCOMPLETE_ID . Model::$STUDY_STATUS] == self::$STATUS_CANCELLED)) {

            $rules[Model::$STUDY_REASON_CANCEL]                     = ['required'];
            $rules[Model::$STUDY_EXPLANATION_CANCEL]                = ['required', 'min:10', 'max:999'];

        }

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



    public static function getParticipants_Email($study) {

        $emails                                                     = [];
        $users                                                      = $study->getParticipants_User;

        foreach ($users as $user) {

            $emails[] = [
                'name' => PersonTrait::getFullName($user->getPerson),
                'email' => $user->{Model::$USER_EMAIL}
            ];
        }

        $emails[] = [
            'name' => PersonTrait::getFullName($study->getHost->getPerson),
            'email' => $study->getHost->{Model::$USER_EMAIL}
        ];

        return $emails;
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

                    $report                                         = $study->getReport($participant);

                    if ($report) {

                        return ReportTrait::getDurationTotal($report);

                    }

                    return self::getDuration($study);

                } else {

                    $durationMax                                    = 0;

                    foreach ($study->getReports as $report) {

                        if (ReportTrait::getDurationTotal($report) > $durationMax) {

                            $durationMax = ReportTrait::getDurationTotal($report);

                        }
                    }

                    return $durationMax;
                }

            default:

                return (strtotime($study->{Model::$STUDY_END}) - strtotime($study->{Model::$STUDY_START})) / 60.0;
        }
    }



    public static function getSubject($study) {

        return $study->getAgreements[0]->getSubject;

    }



    public static function getDescription($study, $for_host = false) {

        $agreement = $study->getAgreements[0];

        $description = __($agreement->getService->{Model::$SERVICE_SHORT}) . " " . __($agreement->getSubject->{Model::$SUBJECT_NAME}) . " met ";

        if ($for_host) {

            $students = '';

            foreach ($study->getAgreements as $participant) {

                $students = (strlen($students) > 0 ? $students . ' en ' : $students);
                $students .= $participant->getStudent->getPerson->{Model::$PERSON_FIRST_NAME};

            }

            $description .= $students;

        } else {

            $description .= $study->getHost_User->getPerson->{Model::$PERSON_FIRST_NAME};

        }

        return $description;
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
            self::$STATUS_CREATED                                   => self::getStatusText(self::$STATUS_CREATED),
            self::$STATUS_PLANNED                                   => self::getStatusText(self::$STATUS_PLANNED),
            self::$STATUS_ACTIVE                                    => self::getStatusText(self::$STATUS_ACTIVE),
            self::$STATUS_FINISHED                                  => self::getStatusText(self::$STATUS_FINISHED),
            self::$STATUS_REPORTED                                  => self::getStatusText(self::$STATUS_REPORTED),
            self::$STATUS_CANCELLED                                 => self::getStatusText(self::$STATUS_CANCELLED),
            self::$STATUS_ABSENT                                    => self::getStatusText(self::$STATUS_ABSENT)
        ];
    }



    public static function getReasonCancelText($reason) {

        switch ($reason) {

            case self::$REASON_CANCEL_CUSTOMER:                     return __('Schuld van de leerling of klant');
            case self::$REASON_CANCEL_STUDIED:                      return __('Schuld van de student-docent');
            default:                                                return __('Onbekend');
        }
    }



    public static function getReasonCancelData() {

        return [
            self::$REASON_CANCEL_CUSTOMER                           => self::getReasonCancelText(self::$REASON_CANCEL_CUSTOMER),
            self::$REASON_CANCEL_STUDIED                            => self::getReasonCancelText(self::$REASON_CANCEL_STUDIED)
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




    public static function generateCalendarInvite($study) {

        return Func::generate_calendar_invite(
            'study-' . $study->{Model::$BASE_KEY} . '@studied.nl',
            StudyTrait::getDescription($study),
            StudyTrait::getDescription($study),
            $study->{Model::$STUDY_LOCATION_TEXT},
            $study->{Model::$STUDY_START},
            $study->{Model::$STUDY_END},
            PersonTrait::getFullName($study->getHost->getPerson),
            'info@studied.nl',
            StudyTrait::getParticipants_Email($study)
        );
    }




    public static function scheduled_report_weekly() {

        Mail::reportWeekly(
            self::scheduled_report_weekly__agreement_deficits(),
            self::scheduled_report_weekly__unreported_studies()
        );

        return true;
    }



    public static function scheduled_report_weekly__agreement_deficits() {

        $agreement_deficits = [];
        $agreements = Agreement::where(Model::$AGREEMENT_STATUS, '!=', AgreementTrait::$STATUS_FINISHED)
            ->where(Model::$AGREEMENT_START, '<', date(Format::$DATABASE_DATE))
            ->where(Model::$AGREEMENT_START, '>=', '2025-04-01')
            ->where(Model::$AGREEMENT_PLAN, '!=', AgreementTrait::$PLAN_LOSSE_LESSEN)
            ->get();

        foreach ($agreements as $agreement) {

            $deficit = AgreementTrait::calculateDeficit($agreement);

            if ($deficit > 0) {

                if (!array_key_exists($agreement->{Model::$STUDENT}, $agreement_deficits)) {

                    $name = PersonTrait::getFullName($agreement->getStudent->getPerson);

                    $agreement_deficits[$agreement->{Model::$STUDENT}] = [$name, 0];
                }

                $agreement_deficits[$agreement->{Model::$STUDENT}][1] += $deficit;
            }
        }

        uasort($agreement_deficits, function($a, $b) {
            return $a[1] < $b[1];
        });

        return $agreement_deficits;
    }



    public static function scheduled_report_weekly__unreported_studies() {

        $unreported_studies = [];
        $studies = Study::where(Model::$STUDY_END, '<', date(Format::$DATABASE_DATE))
            ->where(Model::$STUDY_STATUS, StudyTrait::$STATUS_PLANNED)
            ->get();

        foreach ($studies as $study) {

            // Exception list
            if (in_array($study->{Model::$STUDY_HOST_USER}, [381])) {

                continue;

            }

            if (!array_key_exists($study->{Model::$STUDY_HOST_USER}, $unreported_studies)) {

                if ($study->getHost_User->{Model::$USER_STATUS} == UserTrait::$STATUS_ENDED) {

                    continue;

                }

                $name = PersonTrait::getFullName($study->getHost_User->getPerson);

                $unreported_studies[$study->{Model::$STUDY_HOST_USER}] = [$name, 0];
            }

            $unreported_studies[$study->{Model::$STUDY_HOST_USER}][1]++;
        }

        return $unreported_studies;
    }





}
