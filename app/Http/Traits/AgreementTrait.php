<?php



namespace App\Http\Traits;

use App\Http\Support\Color;
use App\Http\Support\Format;
use App\Http\Support\Func;
use App\Http\Support\Key;
use App\Http\Support\Mail;
use App\Http\Support\Model;
use App\Models\Agreement;
use App\Models\Study;
use App\Models\Study_user;


trait AgreementTrait {





    public static

        $STATUS_UNAPPROVED                      = 1,
        $STATUS_PLANNED                         = 2,
        $STATUS_ACTIVE                          = 3,
        $STATUS_EXPIRED                         = 4,
        $STATUS_FINISHED                        = 5;





    public static function create($data, $id = 1) {

        $suffix                                                 = '_' . $id;

        $agreement                                              = new Agreement();

        $agreement->{Model::$AGREEMENT_IDENTIFIER}              = self::generateIdentifier();
        $agreement->{Model::$AGREEMENT_STATUS}                  = self::$STATUS_UNAPPROVED;

        $agreement->{Model::$STUDENT}                           = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT . $suffix];
        $agreement->{Model::$EMPLOYEE}                          = $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . $suffix];
        $agreement->{Model::$SUBJECT}                           = $data[Key::AUTOCOMPLETE_ID . Model::$SUBJECT . $suffix];
        $agreement->{Model::$LEVEL}                             = $data[Key::AUTOCOMPLETE_ID . Model::$LEVEL . $suffix];

        $agreement->{Model::$AGREEMENT_START}                   = $data[Model::$AGREEMENT_START . $suffix];
        $agreement->{Model::$AGREEMENT_END}                     = $data[Model::$AGREEMENT_END . $suffix];
        $agreement->{Model::$AGREEMENT_MIN}                     = $data[Model::$AGREEMENT_MIN . $suffix];
        $agreement->{Model::$AGREEMENT_MAX}                     = $data[Model::$AGREEMENT_MAX . $suffix];
        $agreement->{Model::$AGREEMENT_REMARK}                  = $data[Model::$AGREEMENT_REMARK . $suffix];



        $replace                                                = $data[Key::AUTOCOMPLETE_ID . 'replace' . $suffix];

        if ($replace > 0) {

            $agreement_replace                                  = Agreement::find($replace);

            if (self::replace($agreement, $agreement_replace)) {

                $agreement->{Model::$AGREEMENT_EXTENSION}       = $agreement_replace->{Model::$AGREEMENT_IDENTIFIER};

            }
        }



        $agreement->save();



        if (self::isExtension($agreement)) {

            Mail::agreementExtended_forEmployee($agreement);

        } else {

            Mail::agreementCreated_forEmployee($agreement);

        }




        return $agreement;
    }



    public static function createFromEvaluation($data) {

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

        Mail::agreementFinished_forEmployee($agreement);

        return true;
    }



    public static function approve($study, $user) {

        $agreement                                              = Study_user::where(Model::$STUDY, $study->id)->where(Model::$USER, $user->id)->firstOrFail()->getAgreement;
        $agreement->{Model::$AGREEMENT_STATUS}                  = self::$STATUS_ACTIVE;
        $agreement->save();

        if (!UserTrait::isActivated($user) && !UserTrait::sentActivation($user)) {

            Mail::userActivate_forStudent($user, $study);

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
    }



    public static function planNowTrial($agreement) {

        return $agreement->{Model::$AGREEMENT_STATUS} == self::$STATUS_UNAPPROVED &&
            !$agreement->{Model::$AGREEMENT_EXTENSION} &&
            !Study_user::where(Model::$AGREEMENT, $agreement->id)->exists();
    }



    public static function hasNowTrial($agreement) {

        return $agreement->{Model::$AGREEMENT_STATUS} == self::$STATUS_UNAPPROVED &&
            !$agreement->{Model::$AGREEMENT_EXTENSION} &&
            (Study_user::where(Model::$AGREEMENT, $agreement->id)->count() == 1) &&
            (Study_user::where(Model::$AGREEMENT, $agreement->id)->first()->{Model::$STUDY_STATUS} != StudyTrait::$STATUS_REPORTED);
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

        return $agreement->getSubject->{Model::$SUBJECT_NAME} . ' met <span style="font-weight: 600">'
            . ($for_host ? $agreement->getStudent->getPerson->{Model::$PERSON_FIRST_NAME} : $agreement->getEmployee->getPerson->{Model::$PERSON_FIRST_NAME})
            . '</span>,<br> actief tot ' . Format::datetime($agreement->{Model::$AGREEMENT_END}, Format::$DATETIME_AGREEMENT) . '.';
    }



    public static function getVakcode($agreement) {

        return $agreement->getSubject->{Model::$SUBJECT_CODE} . '-' . $agreement->getLevel->{Model::$LEVEL_CODE};

    }



    public static function getStatus($agreement) {

        switch($agreement->{Model::$AGREEMENT_STATUS}) {

            case self::$STATUS_PLANNED:
                return Func::has_passed($agreement->{Model::$AGREEMENT_START}) ? (Func::has_passed($agreement->{Model::$AGREEMENT_END}) ? self::$STATUS_PLANNED : self::$STATUS_ACTIVE) : self::$STATUS_EXPIRED;
            default:
                return $agreement->{Model::$AGREEMENT_STATUS};
        }
    }



    public static function getTrial($agreement) {

        $study_user                                 = Study_user::where(Model::$AGREEMENT, $agreement->id)->first();

        return $study_user ? $study_user->getStudy : null;

    }



    public static function getStatusText($status) {

        switch ($status) {
            case self::$STATUS_UNAPPROVED:          return "Onder voorbehoud";
            case self::$STATUS_PLANNED:             return "Gepland";
            case self::$STATUS_ACTIVE:              return "Actief";
            case self::$STATUS_EXPIRED:             return "Verlopen";
            case self::$STATUS_FINISHED:            return "Afgehandeld";
            default:                                return Key::UNKNOWN;
        }
    }



    public static function getStatusTextColor($status) {

        switch ($status) {
            case self::$STATUS_FINISHED:
            case self::$STATUS_PLANNED:             return Color::BLACK;
            case self::$STATUS_ACTIVE:
            case self::$STATUS_UNAPPROVED:
            case self::$STATUS_EXPIRED:
            default:                                return Color::WHITE;
        }
    }



    public static function getStatusColor($status) {

        switch ($status) {
            case self::$STATUS_FINISHED:
            case self::$STATUS_PLANNED:             return Color::GREY_90;
            case self::$STATUS_ACTIVE:              return Color::GREEN;
            case self::$STATUS_UNAPPROVED:
            case self::$STATUS_EXPIRED:
            default:                                return Color::ORANGE;
        }
    }





}
