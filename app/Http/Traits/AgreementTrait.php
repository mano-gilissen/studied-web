<?php



namespace App\Http\Traits;

use App\Http\Support\Color;
use App\Http\Support\Format;
use App\Http\Support\Func;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Agreement;
use App\Models\Study;
use App\Models\Study_user;


trait AgreementTrait {





    public static

        $STATUS_PLANNED                         = 1,
        $STATUS_ACTIVE                          = 2,
        $STATUS_EXPIRED                         = 3;





    public static function create($data, $id = null) {

        $suffix                                                 = $id ? '_' . $id : '';

        $agreement                                              = new Agreement();

        $agreement->{Model::$AGREEMENT_IDENTIFIER}              = self::generateIdentifier();

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
        $agreement_replace->save();

        return true;
    }



    public static function isNowTrail($agreement) {

        return !$agreement->{Model::$AGREEMENT_EXTENSION} && !Study_user::where(Model::$AGREEMENT, $agreement->id)->exists();

    }



    public static function generateIdentifier() {

        // TODO: REPLACE IDENTIFIER WITH FIXED VALUE TO TEST;

        $identifier                                             = date(Format::$DATE_SINGLE, time()) . '-' . chr(rand(65,90));

        $exists                                                 = Agreement::where(Model::$AGREEMENT_IDENTIFIER, $identifier)->exists();

        return $exists ? self::generateIdentifier() : $identifier;
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

        // TODO: ADD INTAKE (BEFORE SUCCESFUL REPORTING OF TRIAL)

        return Func::has_passed($agreement->{Model::$AGREEMENT_START}) ? (Func::has_passed($agreement->{Model::$AGREEMENT_END}) ? 1 : 2) : 3;

    }



    public static function getStatusText($status) {

        switch ($status) {
            case self::$STATUS_PLANNED:             return "Gepland";
            case self::$STATUS_ACTIVE:              return "Actief";
            case self::$STATUS_EXPIRED:             return "Verlopen";
            default:                                return Key::UNKNOWN;
        }
    }



    public static function getStatusTextColor($status) {

        switch ($status) {
            case self::$STATUS_PLANNED:             return Color::BLACK;
            case self::$STATUS_ACTIVE:
            case self::$STATUS_EXPIRED:
            default:                                return Color::WHITE;
        }
    }



    public static function getStatusColor($status) {

        switch ($status) {
            case self::$STATUS_PLANNED:             return Color::GREY_90;
            case self::$STATUS_ACTIVE:              return Color::GREEN;
            case self::$STATUS_EXPIRED:
            default:                                return Color::ORANGE;
        }
    }





}
