<?php



namespace App\Http\Traits;



trait PersonTrait {



    public static

        $PERSON                                         = 'person',

        $PERSON_FIRST_NAME                              = 'first_name',
        $PERSON_MIDDLE_NAME                             = 'middle_name',
        $PERSON_LAST_NAME                               = 'last_name',
        $PERSON_PREFIX                                  = 'prefix',
        $PERSON_EMAIL                                   = 'email',
        $PERSON_PHONE                                   = 'phone',
        $PERSON_BIRTH_DATE                              = 'birth_date',
        $PERSON_AVATAR                                  = 'avatar';





    public static function getFullName($person, $with_prefix = false) {

        if (!$person) {

            return false;

        }

        $prefix                 = $person->{self::$PERSON_PREFIX};
        $first_name             = $person->{self::$PERSON_FIRST_NAME};
        $middle_name            = $person->{self::$PERSON_MIDDLE_NAME};
        $last_name              = $person->{self::$PERSON_LAST_NAME};

        return ($with_prefix && $prefix ? $prefix . ' ': '') . $first_name . ' ' . ($middle_name ? $middle_name . ' ' : '') . $last_name;
    }



    public static function getInitials($person) {

        if (!$person) {

            return false;

        }
        $first_name             = $person->{self::$PERSON_FIRST_NAME};
        $last_name              = $person->{self::$PERSON_LAST_NAME};

        return substr($first_name, 0, 1) . substr($last_name, 0, 1) ;
    }



}
