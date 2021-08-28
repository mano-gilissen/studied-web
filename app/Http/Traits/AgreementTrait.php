<?php



namespace App\Http\Traits;

use App\Http\Support\Format;
use App\Http\Support\Func;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Agreement;



trait AgreementTrait {



    public static function create($data, $id = null) {

        $suffix                                                 = $id ? '_' . $id : '';

        $agreement                                              = new Agreement();

        $agreement->{Model::$AGREEMENT_IDENTIFIER}              = self::generateIdentifier();

        $agreement->{Model::$STUDENT}                           = $data[Key::AUTOCOMPLETE_ID . Model::$STUDENT . $suffix];
        $agreement->{Model::$EMPLOYEE}                          = $data[Key::AUTOCOMPLETE_ID . Model::$EMPLOYEE . $suffix];
        $agreement->{Model::$SUBJECT}                           = $data[Key::AUTOCOMPLETE_ID . Model::$SUBJECT . $suffix];
        $agreement->{Model::$LEVEL}                             = $data[Key::AUTOCOMPLETE_ID . Model::$LEVEL . $suffix];

        $agreement->{Model::$AGREEMENT_END}                     = $data[Model::$AGREEMENT_END . $suffix];
        $agreement->{Model::$AGREEMENT_MIN}                     = $data[Model::$AGREEMENT_MIN . $suffix];
        $agreement->{Model::$AGREEMENT_MAX}                     = $data[Model::$AGREEMENT_MAX . $suffix];
        $agreement->{Model::$AGREEMENT_REMARK}                  = $data[Model::$AGREEMENT_REMARK . $suffix];



        $replace                                                = $data[Key::AUTOCOMPLETE_ID . 'replace' . $suffix];

        if ($replace > 0) {

            $agreement_replace                                  = Agreement::find($replace);

            if (self::replace($agreement_replace)) {

                $agreement->{Model::$AGREEMENT_EXTENSION}       = true;

            }
        }



        dd($agreement);



        $agreement->save();



        return $agreement;
    }



    public static function createFromEvaluation($data) {

        foreach ($data as $key => $value) {

            if (Func::contains($key, Model::$STUDENT) && strlen($data[$key]) > 0) {

                $id                                             = str_replace(Model::$STUDENT . '_', '', $key);

                self::create($data, $id);
            }
        }
    }



    public static function replace($agreement) {

        if (!$agreement) {

            return false;

        }

        //

        return true;
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



}
