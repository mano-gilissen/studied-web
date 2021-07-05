<?php



namespace App\Http\Traits;

use App\Http\Support\Key;
use App\Http\Support\Color;



trait StudyTrait {



    public static

        $STUDY                                          = 'study',

        $STUDY_STATUS                                   = 'status',
        $STUDY_HOST_USER                                = 'host_user',
        $STUDY_HOST_RELATION                            = 'host_relation',
        $STUDY_SUBJECT_DEFINED                          = 'subject_defined',
        $STUDY_SUBJECT_TEXT                             = 'subject_text',
        $STUDY_LOCATION_DEFINED                         = 'location_defined',
        $STUDY_LOCATION_TEXT                            = 'location_text',
        $STUDY_DATE                                     = 'date',
        $STUDY_START                                    = 'start',
        $STUDY_END                                      = 'end',
        $STUDY_TRIAL                                    = 'trial',

        $STATUS_CREATED                                 = 0,
        $STATUS_PLANNED                                 = 1,
        $STATUS_FINISHED                                = 2,
        $STATUS_REPORTED                                = 3,
        $STATUS_CANCELLED                               = 4,
        $STATUS_ABSENT                                  = 5;



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

            case self::$STATUS_CREATED:
            case self::$STATUS_CANCELLED:
            case self::$STATUS_ABSENT:                  return Color::RED;
            case self::$STATUS_REPORTED:                return Color::GREEN;
            case self::$STATUS_PLANNED:
            case self::$STATUS_FINISHED:
            default:                                    return Color::GREY_90;
        }
    }



    public static function getStatusTextColor($study) {

        switch ($study->status) {

            case self::$STATUS_CREATED:
            case self::$STATUS_CANCELLED:
            case self::$STATUS_REPORTED:
            case self::$STATUS_ABSENT:                  return Color::WHITE;
            case self::$STATUS_PLANNED:
            case self::$STATUS_FINISHED:
            default:                                    return Key::UNKNOWN;
        }
    }



}
