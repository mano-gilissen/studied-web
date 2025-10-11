<?php

namespace App\Http\Traits;

use App\Http\Support\Color;
use App\Http\Support\Format;
use App\Http\Support\Func;
use App\Http\Support\Key;
use App\Http\Support\Mail;
use App\Http\Support\Model;
use App\Models\Agreement;
use App\Models\Evaluation;
use App\Models\Report;
use App\Models\Study;
use App\Models\Study_user;
use Illuminate\Support\Facades\Lang;



trait AgreementTrait {





    public static

        $STATUS_UNAPPROVED                      = 1,
        $STATUS_TRIAL                           = 2,
        $STATUS_ACTIVE                          = 3,
        $STATUS_EXPIRED                         = 4,
        $STATUS_FINISHED                        = 5,
        $STATUS_PLANNED                         = 6,

        $PLAN_LOSSE_LESSEN                      = 1,
        $PLAN_STRUCTURELE_BEGELEIDING           = 2,
        $PLAN_GEINTEGREERD                      = 3,

        $TRIAL_NO                               = 1,
        $TRIAL_YES                              = 2;





    public static function create($data, $id = 1) {

        $suffix                                                 = '_' . $id;

        $agreement                                              = new Agreement();

        $agreement->{Model::$AGREEMENT_IDENTIFIER}              = self::generateIdentifier();
        $agreement->{Model::$AGREEMENT_STATUS}                  = self::$STATUS_UNAPPROVED;

        $agreement->{Model::$STUDENT}                           = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT . $suffix];
        $agreement->{Model::$EMPLOYEE}                          = $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . $suffix];
        $agreement->{Model::$SERVICE}                           = $data[Key::AUTOCOMPLETE_ID . Model::$SERVICE . $suffix];
        $agreement->{Model::$SUBJECT}                           = $data[Key::AUTOCOMPLETE_ID . Model::$SUBJECT . $suffix];
        $agreement->{Model::$LEVEL}                             = $data[Key::AUTOCOMPLETE_ID . Model::$LEVEL . $suffix];

        $agreement->{Model::$AGREEMENT_PLAN}                    = $data[Key::AUTOCOMPLETE_ID . Model::$AGREEMENT_PLAN . $suffix];
        $agreement->{Model::$AGREEMENT_PREFERENCE_GROUP}        = $data[Key::AUTOCOMPLETE_ID . Model::$AGREEMENT_PREFERENCE_GROUP . $suffix];
        $agreement->{Model::$AGREEMENT_PREFERENCE_LOCATION}     = $data[Key::AUTOCOMPLETE_ID . Model::$AGREEMENT_PREFERENCE_LOCATION . $suffix];

        $agreement->{Model::$AGREEMENT_HOURS}                   = is_numeric($data[Model::$AGREEMENT_HOURS . $suffix]) ? $data[Model::$AGREEMENT_HOURS . $suffix] : 0;
        $agreement->{Model::$AGREEMENT_START}                   = $data[Model::$AGREEMENT_START . $suffix];
        $agreement->{Model::$AGREEMENT_END}                     = $data[Model::$AGREEMENT_END . $suffix];
        $agreement->{Model::$AGREEMENT_REMARK}                  = $data[Model::$AGREEMENT_REMARK . $suffix];



        $replace                                                = $data[Key::AUTOCOMPLETE_ID . 'replace' . $suffix];

        if ($replace > 0) {

            $agreement_replace                                  = Agreement::find($replace);

            if (self::replace($agreement, $agreement_replace)) {

                $agreement->{Model::$AGREEMENT_EXTENSION}       = $agreement_replace->{Model::$AGREEMENT_IDENTIFIER};
                $agreement->{Model::$AGREEMENT_STATUS}          = self::$STATUS_ACTIVE;
            }
        }



        $trial                                                  = array_key_exists('trial' . $suffix, $data) ? $data['trial' . $suffix] : self::$TRIAL_YES;

        if ($trial == self::$TRIAL_NO) {

            $agreement->{Model::$AGREEMENT_STATUS}              = self::$STATUS_ACTIVE;

        }



        if (array_key_exists(Key::AUTOCOMPLETE_ID . Model::$EVALUATION, $data)) {

            $evaluation                                         = Evaluation::findOrFail($data[Key::AUTOCOMPLETE_ID . Model::$EVALUATION]);
            $agreement->{Model::$EVALUATION}                    = $evaluation->{Model::$BASE_ID};
        }



        $agreement->save();



        if (self::isExtension($agreement)) {

            Mail::agreementExtended_forEmployee($agreement);

        } else {

            Mail::agreementCreated_forEmployee($agreement);

        }



        return $agreement;
    }



    public static function create_fromEvaluation($data) {

        foreach ($data as $key => $value) {

            if (Func::contains($key, Key::AUTOCOMPLETE_ID . Model::$STUDENT) && strlen($data[$key]) > 0) {

                $id                                             = str_replace(Key::AUTOCOMPLETE_ID . Model::$STUDENT . '_', '', $key);

                self::create($data, $id);
            }
        }
    }



    public static function replace($agreement, $agreement_replace) {

        if (!$agreement) {

            return false;

        }

        $agreement_replace->{Model::$AGREEMENT_END}             = $agreement->{Model::$AGREEMENT_START};
        $agreement_replace->{Model::$AGREEMENT_STATUS}          = self::$STATUS_FINISHED;
        $agreement_replace->save();

        return true;
    }



    public static function finish($agreement) {

        if (!$agreement) {

            return false;

        }

        $agreement->{Model::$AGREEMENT_STATUS}                  = self::$STATUS_FINISHED;
        $agreement->save();



        $studiesToCancel = Study::whereHas('getAgreements', function ($q) use ($agreement) {

            $q->where(Model::$AGREEMENT, $agreement->{Model::$BASE_ID});

        })->where(Model::$STUDY_STATUS, StudyTrait::$STATUS_PLANNED)->get();

        foreach ($studiesToCancel as $study) {

            if (!StudyTrait::hasStarted($study)) {

                $study->{Model::$STUDY_STATUS}                      = StudyTrait::$STATUS_CANCELLED;
                $study->save();
            }
        }



        Mail::agreementFinished_forEmployee($agreement);

        return true;
    }



    public static function edit($data) {

        $agreement                                              = Agreement::where(Model::$AGREEMENT_IDENTIFIER, $data[Model::$AGREEMENT])->firstOrFail();

        $agreement->{Model::$SUBJECT}                           = $data[Key::AUTOCOMPLETE_ID . Model::$SUBJECT];
        $agreement->{Model::$LEVEL}                             = $data[Key::AUTOCOMPLETE_ID . Model::$LEVEL];

        $agreement->{Model::$AGREEMENT_PREFERENCE_GROUP}        = $data[Key::AUTOCOMPLETE_ID . Model::$AGREEMENT_PREFERENCE_GROUP];
        $agreement->{Model::$AGREEMENT_PREFERENCE_LOCATION}     = $data[Key::AUTOCOMPLETE_ID . Model::$AGREEMENT_PREFERENCE_LOCATION];

        $agreement->{Model::$AGREEMENT_HOURS}                   = is_numeric($data[Model::$AGREEMENT_HOURS]) ? $data[Model::$AGREEMENT_HOURS] : 0;
        $agreement->{Model::$AGREEMENT_START}                   = $data[Model::$AGREEMENT_START];
        $agreement->{Model::$AGREEMENT_END}                     = $data[Model::$AGREEMENT_END];
        $agreement->{Model::$AGREEMENT_REMARK}                  = $data[Model::$AGREEMENT_REMARK];

        $agreement->save();

        return $agreement;
    }



    public static function approve($study, $user) {

        $agreement                                              = Study_user::where(Model::$STUDY, $study->id)->where(Model::$USER, $user->id)->firstOrFail()->getAgreement;
        $agreement->{Model::$AGREEMENT_STATUS}                  = self::$STATUS_ACTIVE;
        $agreement->save();

        if (!UserTrait::isActivated($user) && !UserTrait::sentActivation($user)) {

            Mail::userActivate_forStudent($user, $study);

            //StudentTrait::notifyRelations_ofActivation($user);
        }

        $student                                                = $user->getStudent;

        if ($student && StudentTrait::hasCustomer($student)) {

            $customer                                           = $student->getCustomer->getUser;

            if ($customer && !UserTrait::isActivated($customer) && !UserTrait::sentActivation($customer)) {

                Mail::userActivate_forCustomer($customer, $study, $user);

            } else {

                Mail::agreementApproved_forCustomer($customer, $study, $user, $agreement);

            }
        }
    }



    public static function reject($study, $user) {

        $agreement                                              = Study_user::where(Model::$STUDY, $study->id)->where(Model::$USER, $user->id)->firstOrFail()->getAgreement;
        $agreement->{Model::$AGREEMENT_STATUS}                  = self::$STATUS_FINISHED;
        $agreement->save();

        // TODO: FEEDBACK
        // TODO: STATUS REJECTED
    }



    public static function planNowTrial($agreement) {

        return $agreement->{Model::$AGREEMENT_STATUS} == self::$STATUS_UNAPPROVED;

    }



    public static function hasNowTrial($agreement) {

        return $agreement->{Model::$AGREEMENT_STATUS} == self::$STATUS_PLANNED;

    }



    public static function calculateDeficit($agreement, $hours_total = null, $hours_made = null) {

        $hours_total                                            = $hours_total ?? self::getHoursTotal($agreement);
        $hours_made                                             = $hours_made ?? self::getHoursMade($agreement);

        $duration_total                                         = strtotime($agreement->{Model::$AGREEMENT_END}) - strtotime($agreement->{Model::$AGREEMENT_START});
        $duration_past                                          = time() - strtotime($agreement->{Model::$AGREEMENT_START});

        $progress_duration                                      = min($duration_past / max($duration_total, 1), 1);
        $progress_hours_desired                                 = $progress_duration * $hours_total;

        return round($progress_hours_desired - $hours_made, 2);
    }



    public static function generateIdentifier() {

        // TODO: REPLACE IDENTIFIER WITH FIXED VALUE TO TEST;

        $identifier                                             = date(Format::$DATE_SINGLE, time()) . '-' . chr(rand(65,90));

        $exists                                                 = Agreement::where(Model::$AGREEMENT_IDENTIFIER, $identifier)->exists();

        return $exists ? self::generateIdentifier() : $identifier;
    }



    public static function isExtension($agreement) {

        return strlen($agreement->{Model::$AGREEMENT_EXTENSION}) > 0;

    }



    public static function getDescription($agreement, $for_host = false) {

        return __($agreement->getService->{Model::$SERVICE_SHORT}) . " " . __($agreement->getSubject->{Model::$SUBJECT_NAME}) . ' ' . __('met') . ' <span style="font-weight: 600">'
            . ($for_host ? $agreement->getStudent->getPerson->{Model::$PERSON_FIRST_NAME} : $agreement->getEmployee->getPerson->{Model::$PERSON_FIRST_NAME})
            . '</span>,<br> ' . __('actief tot') . ' ' . Format::datetime($agreement->{Model::$AGREEMENT_END}, Format::$DATETIME_AGREEMENT) . '.';
    }



    public static function getVakcode($agreement) {

        return $agreement->getSubject->{Model::$SUBJECT_CODE} . '-' . $agreement->getLevel->{Model::$LEVEL_CODE};

    }



    public static function getStatus($agreement) {

        switch($agreement->{Model::$AGREEMENT_STATUS}) {

            case self::$STATUS_ACTIVE:
                return Func::has_passed($agreement->{Model::$AGREEMENT_START}) ? (Func::has_passed($agreement->{Model::$AGREEMENT_END}) ? self::$STATUS_EXPIRED : self::$STATUS_ACTIVE) : self::$STATUS_PLANNED;
            default:
                return $agreement->{Model::$AGREEMENT_STATUS};
        }
    }



    public static function getTrial($agreement) {

        $study_user                                 = Study_user::where(Model::$AGREEMENT, $agreement->id)->first();

        return $study_user ? $study_user->getStudy : null;

    }



    public static function getHoursTotal($agreement) {

        return $agreement->{Model::$AGREEMENT_HOURS} * round((strtotime($agreement->{Model::$AGREEMENT_END}) - strtotime($agreement->{Model::$AGREEMENT_START})) / 604800);

    }



    public static function getHoursMade($agreement) {

        $total = 0;

        foreach ($agreement->getStudies as $study) {

            $report = Report::where(Model::$STUDY, $study->{Model::$BASE_ID})->where(Model::$USER, $agreement->{Model::$STUDENT})->first();

            if ($report) {

                $total += ReportTrait::getDurationTotal($report);

            }
        }

        return (float) $total / 60.0;
    }



    public static function getPlanText($plan) {

        switch ($plan) {
            case self::$PLAN_LOSSE_LESSEN:              return __('Losse lessen');
            case self::$PLAN_STRUCTURELE_BEGELEIDING:   return __('Structurele begeleiding');
            case self::$PLAN_GEINTEGREERD:              return __('Geïntegreerd');
            default:                                    return __('Onbekend');
        }
    }



    public static function getStatusText($status) {

        switch ($status) {
            case self::$STATUS_UNAPPROVED:
            case self::$STATUS_TRIAL:               return __('Onder voorbehoud');
            case self::$STATUS_PLANNED:             return __('Gepland');
            case self::$STATUS_ACTIVE:              return __('Actief');
            case self::$STATUS_EXPIRED:             return __('Verlopen');
            case self::$STATUS_FINISHED:            return __('Afgehandeld');
            default:                                return __('Onbekend');
        }
    }



    public static function getStatusTextColor($status) {

        switch ($status) {
            case self::$STATUS_FINISHED:
            case self::$STATUS_PLANNED:             return Color::BLACK;
            case self::$STATUS_TRIAL:
            case self::$STATUS_ACTIVE:
            case self::$STATUS_UNAPPROVED:
            case self::$STATUS_EXPIRED:
            default:                                return Color::WHITE;
        }
    }



    public static function getStatusColor($status) {

        switch ($status) {
            case self::$STATUS_FINISHED:
            case self::$STATUS_TRIAL:               return Color::GREY_90;
            case self::$STATUS_ACTIVE:              return Color::GREEN;
            case self::$STATUS_PLANNED:
            case self::$STATUS_UNAPPROVED:
            case self::$STATUS_EXPIRED:
            default:                                return Color::ORANGE;
        }
    }



    public static function getStatusFilterData() {

        return [
            AgreementTrait::$STATUS_TRIAL                           => AgreementTrait::getStatusText(AgreementTrait::$STATUS_TRIAL),
            AgreementTrait::$STATUS_ACTIVE                          => AgreementTrait::getStatusText(AgreementTrait::$STATUS_ACTIVE),
            AgreementTrait::$STATUS_EXPIRED                         => AgreementTrait::getStatusText(AgreementTrait::$STATUS_EXPIRED),
            AgreementTrait::$STATUS_FINISHED                        => AgreementTrait::getStatusText(AgreementTrait::$STATUS_FINISHED),
            AgreementTrait::$STATUS_PLANNED                         => AgreementTrait::getStatusText(AgreementTrait::$STATUS_PLANNED)
        ];
    }



    public static function getPlanFilterData() {

        return [
            AgreementTrait::$PLAN_LOSSE_LESSEN                      => AgreementTrait::getPlanText(self::$PLAN_LOSSE_LESSEN),
            AgreementTrait::$PLAN_STRUCTURELE_BEGELEIDING           => AgreementTrait::getPlanText(self::$PLAN_STRUCTURELE_BEGELEIDING),
            AgreementTrait::$PLAN_GEINTEGREERD                      => AgreementTrait::getPlanText(self::$PLAN_GEINTEGREERD)
        ];
    }



    public static function getPreferenceGroupData() {

        return [
            1                                                       => __('Beide'),
            2                                                       => __('Individueel'),
            3                                                       => __('Group')
        ];
    }



    public static function getPreferenceLocationData() {

        return [
            1                                                       => __('Beide'),
            2                                                       => __('Digitaal'),
            3                                                       => __('Fysiek')
        ];
    }



    public static function plan_reminders_losse_lessen() {

        $agreements                                            = Agreement::where(Model::$AGREEMENT_PLAN, self::$PLAN_LOSSE_LESSEN)
                                                                          ->where(Model::$AGREEMENT_PLAN_REMINDER_SENT, false)
                                                                          ->where(Model::$AGREEMENT_START, '<=', date(Format::$DATABASE_DATETIME, strtotime('-1 week')))
                                                                          ->get();

        foreach ($agreements as $agreement) {

            if ($agreement->getStudies->count() > 0) {

                continue;

            }

            Mail::agreementReminder_forManagement($agreement);

            $agreement->{Model::$AGREEMENT_PLAN_REMINDER_SENT} = true;
            $agreement->save();
        }
    }



}
