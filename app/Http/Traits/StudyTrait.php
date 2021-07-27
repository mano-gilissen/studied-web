<?php



namespace App\Http\Traits;

use App\Http\Support\Key;
use App\Http\Support\Color;


trait StudyTrait {





    public static

        $STATUS_CREATED                                 = 0,
        $STATUS_PLANNED                                 = 1,
        $STATUS_FINISHED                                = 2,
        $STATUS_REPORTED                                = 3,
        $STATUS_CANCELLED                               = 4,
        $STATUS_ABSENT                                  = 5;





    public static function create(array $data, &$study) {



    }



    public static function getParticipants_Person($study) {

        $persons                                        = [];

        $users                                          = $study->getParticipants_User()->get();
        $participants                                   = $study->getParticipants_Participant()->get();

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

            case self::$STATUS_CREATED:                 return "Aangemaakt";
            case self::$STATUS_PLANNED:                 return "Ingepland";
            case self::$STATUS_FINISHED:                return "Afgelopen";
            case self::$STATUS_REPORTED:                return "Gerapporteerd";
            case self::$STATUS_CANCELLED:               return "Geannuleerd";
            case self::$STATUS_ABSENT:                  return "Verzuimd";
            default:                                    return Key::UNKNOWN;
        }
    }



    public static function getStatusColor($study) {

        switch ($study->status) {

            case self::$STATUS_CANCELLED:
            case self::$STATUS_ABSENT:                  return Color::RED;
            case self::$STATUS_REPORTED:                return Color::GREEN;
            case self::$STATUS_FINISHED:                return Color::ORANGE;
            case self::$STATUS_CREATED:
            case self::$STATUS_PLANNED:
            default:                                    return Color::GREY_80;
        }
    }



    public static function getStatusTextColor($study) {

        switch ($study->status) {

            case self::$STATUS_CREATED:
            case self::$STATUS_CANCELLED:
            case self::$STATUS_REPORTED:
            case self::$STATUS_ABSENT:
            case self::$STATUS_PLANNED:
            case self::$STATUS_FINISHED:                return Color::WHITE;
            default:                                    return Key::UNKNOWN;
        }
    }



}
