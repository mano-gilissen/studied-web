<?php



namespace App\Http\Traits;

use App\Http\Support\Key;
use App\Http\Support\Color;
use App\Http\Support\Model;
use App\Http\Support\Func;
use App\Models\Agreement;
use App\Models\Study;


trait StudyTrait {





    public static

        $STATUS_CREATED                                     = 0,
        $STATUS_PLANNED                                     = 1,
        $STATUS_FINISHED                                    = 2,
        $STATUS_REPORTED                                    = 3,
        $STATUS_CANCELLED                                   = 4,
        $STATUS_ABSENT                                      = 5;





    public static function create(array $data, &$study) {

        $study                                              = new Study;

        $study->{Model::$BASE_KEY}                          = Func::generate_key();

        $study->{Model::$STUDY_DATE}                        = $data[Model::$STUDY_DATE];
        $study->{Model::$STUDY_START}                       = $data[Model::$STUDY_START];
        $study->{Model::$STUDY_END}                         = $data[Model::$STUDY_END];

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



        /*   FOR PUBLIC SERVICES (COLLEGE/GROEPSLES):

        $study->{Model::$SERVICE}                           = ;
        $study->{Model::$STUDY_STATUS}                      = self::$STATUS_PLANNED; // TODO: STATUS FINISHED IF DATE < NOW. TODO: STUDY WITH NO DATE (CREATED INSTEAD OF PLANNED)
        $study->{Model::$STUDY_HOST_USER}                   = ;
        $study->{Model::$STUDY_SUBJECT_DEFINED}             = $data[Key::AUTOCOMPLETE_ID . Model::$SUBJECT]; // TODO: STUDY SUBJECT TEXT IF NO DEFINED

        */



        dd($study);

        $study->save();



        foreach ($agreements as $agreement) {

            Study_UserTrait::create($study, $agreement);

        }



        return $study;
    }



    public static function getParticipants_Person($study) {

        $persons                                            = [];

        $users                                              = $study->getParticipants_User()->get();
        $participants                                       = $study->getParticipants_Participant()->get();

        foreach ($users as $user) {

            array_push($persons, $user->getPerson);

        }

        foreach ($participants as $participant) {

            array_push($persons, $participant->getPerson);

        }

        return $persons;
    }



    public static function getStatus($study) {

        switch ($study->status) {

            case self::$STATUS_CREATED:                     return "Aangemaakt";
            case self::$STATUS_PLANNED:                     return "Ingepland";
            case self::$STATUS_FINISHED:                    return "Afgelopen";
            case self::$STATUS_REPORTED:                    return "Gerapporteerd";
            case self::$STATUS_CANCELLED:                   return "Geannuleerd";
            case self::$STATUS_ABSENT:                      return "Verzuimd";
            default:                                        return Key::UNKNOWN;
        }
    }



    public static function getStatusColor($study) {

        switch ($study->status) {

            case self::$STATUS_CANCELLED:
            case self::$STATUS_ABSENT:                      return Color::RED;
            case self::$STATUS_REPORTED:                    return Color::GREEN;
            case self::$STATUS_FINISHED:                    return Color::ORANGE;
            case self::$STATUS_CREATED:
            case self::$STATUS_PLANNED:
            default:                                        return Color::GREY_80;
        }
    }



    public static function getStatusTextColor($study) {

        switch ($study->status) {

            case self::$STATUS_CREATED:
            case self::$STATUS_CANCELLED:
            case self::$STATUS_REPORTED:
            case self::$STATUS_ABSENT:
            case self::$STATUS_PLANNED:
            case self::$STATUS_FINISHED:                    return Color::WHITE;
            default:                                        return Key::UNKNOWN;
        }
    }



}
