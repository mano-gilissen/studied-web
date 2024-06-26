<?php



namespace App\Http\Traits;

use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Person;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;



trait PersonTrait {





    public static function create(array $data, $person = null) {

        self::validate($data);

        $person                                                         = $person ? $person : new Person;

        $person->{Model::$PERSON_PREFIX}                                = $data[Model::$PERSON_PREFIX];
        $person->{Model::$PERSON_FIRST_NAME}                            = $data[Model::$PERSON_FIRST_NAME];
        $person->{Model::$PERSON_MIDDLE_NAME}                           = $data[Model::$PERSON_MIDDLE_NAME];
        $person->{Model::$PERSON_LAST_NAME}                             = $data[Model::$PERSON_LAST_NAME];
        $person->{Model::$PERSON_BIRTH_DATE}                            = $data[Model::$PERSON_BIRTH_DATE] . ' 00:00:00';
        $person->{Model::$PERSON_REFER}                                 = $data[Model::$PERSON_REFER];

        $person->{Model::$PERSON_PHONE}                                 = $data[Model::$PERSON_PHONE];

        $person->{Model::$PERSON_COMPANY}                               = array_key_exists(Model::$PERSON_COMPANY, $data) ? $data[Model::$PERSON_COMPANY] : '';
        $person->{Model::$PERSON_SOCIAL_INSTAGRAM}                      = array_key_exists(Model::$PERSON_SOCIAL_INSTAGRAM, $data) ? $data[Model::$PERSON_SOCIAL_INSTAGRAM] : '';
        $person->{Model::$PERSON_SOCIAL_LINKEDIN}                       = array_key_exists(Model::$PERSON_SOCIAL_LINKEDIN, $data) ? $data[Model::$PERSON_SOCIAL_LINKEDIN] : '';

        $person->{Model::$PERSON_SLUG}                                  = self::createSlug($person);

        $person->save();

        return $person;
    }



    public static function update(array $data, $person) {

        self::validate($data);

        $person->{Model::$PERSON_PREFIX}                                = $data[Model::$PERSON_PREFIX];
        $person->{Model::$PERSON_FIRST_NAME}                            = $data[Model::$PERSON_FIRST_NAME];
        $person->{Model::$PERSON_MIDDLE_NAME}                           = $data[Model::$PERSON_MIDDLE_NAME];
        $person->{Model::$PERSON_LAST_NAME}                             = $data[Model::$PERSON_LAST_NAME];
        $person->{Model::$PERSON_REFER}                                 = $data[Model::$PERSON_REFER];
        $person->{Model::$PERSON_PHONE}                                 = $data[Model::$PERSON_PHONE];

        $person->{Model::$PERSON_BIRTH_DATE}                            = array_key_exists(Model::$PERSON_BIRTH_DATE, $data) ? $data[Model::$PERSON_BIRTH_DATE] . ' 00:00:00' : '1970-01-01 00:00:00';
        $person->{Model::$PERSON_COMPANY}                               = array_key_exists(Model::$PERSON_COMPANY, $data) ? $data[Model::$PERSON_COMPANY] : '';
        $person->{Model::$PERSON_SOCIAL_INSTAGRAM}                      = array_key_exists(Model::$PERSON_SOCIAL_INSTAGRAM, $data) ? $data[Model::$PERSON_SOCIAL_INSTAGRAM] : '';
        $person->{Model::$PERSON_SOCIAL_LINKEDIN}                       = array_key_exists(Model::$PERSON_SOCIAL_LINKEDIN, $data) ? $data[Model::$PERSON_SOCIAL_LINKEDIN] : '';

        $person->{Model::$PERSON_SLUG}                                  = self::createSlug($person);

        $person->save();

        return $person;

    }



    public static function validate(array $data) {

        $rules                                                          = [];

        $rules[Model::$PERSON_PREFIX]                                   = ['required'];
        $rules[Model::$PERSON_FIRST_NAME]                               = ['required'];
        $rules[Model::$PERSON_LAST_NAME]                                = ['required'];

        if (array_key_exists(Model::$PERSON_BIRTH_DATE, $data)) {

            $rules[Model::$PERSON_BIRTH_DATE]                           = ['required'];

        }

        if (array_key_exists(Key::AUTOCOMPLETE_ID . Model::$USER_CATEGORY, $data) && $data[Key::AUTOCOMPLETE_ID . Model::$USER_CATEGORY] == RoleTrait::$CATEGORY_CUSTOMER_COMPANY) {

            $rules[Model::$PERSON_COMPANY]                              = ['required'];

        }

        $validator                                                      = Validator::make($data, $rules, BaseTrait::getValidationMessages());

        $validator->validate();
    }





    public static function createSlug($person, $addition = 0) {

        if (self::isCompany($person) && $person->{Model::$PERSON_COMPANY} && strlen($person->{Model::$PERSON_COMPANY}) > 0) {

            $content                                                    = $person->{Model::$PERSON_COMPANY};

        } else {

            $content                                                    = $person->{Model::$PERSON_FIRST_NAME} . ' ' . (strlen($person->{Model::$PERSON_MIDDLE_NAME}) > 0 ? $person->{Model::$PERSON_MIDDLE_NAME} . ' ' : '') . $person->{Model::$PERSON_LAST_NAME};

        }

        $slug                                                           = str_replace(' ', '-', strtolower($content)) . ($addition > 0 ? "-" .  $addition : "");

        if (Person::where(Model::$PERSON_SLUG, $slug)->exists() && $person->{Model::$PERSON_SLUG} != $slug) {

            return self::createSlug($person, $addition + 1);

        }

        return $slug;
    }





    public static function getFullName($person, $with_prefix = false) {

        if (!$person) {

            return false;

        }

        $prefix                                                         = $person->{Model::$PERSON_PREFIX};
        $first_name                                                     = $person->{Model::$PERSON_FIRST_NAME};
        $middle_name                                                    = $person->{Model::$PERSON_MIDDLE_NAME};
        $last_name                                                      = $person->{Model::$PERSON_LAST_NAME};

        return ($with_prefix && $prefix ? $prefix . ' ': '') . $first_name . ' ' . ($middle_name ? $middle_name . ' ' : '') . $last_name;
    }



    public static function getInitials($person) {

        if (!$person) {

            return false;

        }

        $first_name                                                     = $person->{Model::$PERSON_FIRST_NAME};
        $last_name                                                      = $person->{Model::$PERSON_LAST_NAME};

        return substr($first_name, 0, 1) . substr($last_name, 0, 1) ;
    }



    public static function getSubtitle($person) {

        if (!$person) {

            return false;

        }

        $user                                                           = $person->getUser;

        switch($user->role) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_EMPLOYEE:
                return $user->getEmployee->{Model::$EMPLOYEE_SCHOOL_CURRENT} ?? UserTrait::getRoleName($user, true);
            case RoleTrait::$ID_STUDENT:
                return $user->getStudent->{Model::$STUDENT_SCHOOL};
            case RoleTrait::$ID_CUSTOMER:
                return UserTrait::getRoleName($user, true);
            default:
                return __("Gebruiker");
        }
    }



    public static function getProfileTitle($person) {

        if (self::isCompany($person)) {

            return $person->{Model::$PERSON_COMPANY} && strlen($person->{Model::$PERSON_COMPANY}) > 0 ? $person->{Model::$PERSON_COMPANY} : self::getFullName($person);

        }

        return self::getFullName($person);
    }



    public static function getProfileComment($person) {

        if (!$person) {

            return false;

        }

        if (self::isUser($person)) {

            switch($person->getUser->role) {

                case RoleTrait::$ID_ADMINISTRATOR:
                case RoleTrait::$ID_BOARD:
                    return strlen($person->getUser->getEmployee->{Model::$EMPLOYEE_PROFILE_TEXT}) > 0 ? __($person->getUser->getEmployee->{Model::$EMPLOYEE_PROFILE_TEXT}) : __('Hoi Ik ben :first_name en ik zit bij het bestuur van Studied.', ['first_name' => $person->{Model::$PERSON_FIRST_NAME}]);

                case RoleTrait::$ID_MANAGEMENT:
                    return strlen($person->getUser->getEmployee->{Model::$EMPLOYEE_PROFILE_TEXT}) > 0 ? __($person->getUser->getEmployee->{Model::$EMPLOYEE_PROFILE_TEXT}) : __('Hoi Ik ben :first_name en ik werk bij Studied als managing-student.', ['first_name' => $person->{Model::$PERSON_FIRST_NAME}]);

                case RoleTrait::$ID_EMPLOYEE:
                    return __('Hoi! Ik ben :first_name en ik studeer :current_study.', ['first_name' => $person->{Model::$PERSON_FIRST_NAME}, 'current_study' => $person->getUser->getEmployee->{Model::$EMPLOYEE_PROFILE_CURRENT}]);

                case RoleTrait::$ID_STUDENT:

                    $customer = $person->getUser->getStudent->getCustomer;

                    if ($customer != null && $customer->getUser->{Model::$USER_CATEGORY} == RoleTrait::$CATEGORY_CUSTOMER_COMPANY) {

                        return '';

                    }

                    return __('Hoi! Ik ben :first_name en ik zit op :niveau_text :leerjaar:school', ['first_name' => $person->{Model::$PERSON_FIRST_NAME}, 'niveau_text' => StudentTrait::getNiveauText($person->getUser->getStudent->niveau), 'leerjaar' => $person->getUser->getStudent->leerjaar, 'school' => $person->getUser->getStudent->school ? ' van ' . $person->getUser->getStudent->school . '.' : '']);

                case RoleTrait::$ID_CUSTOMER:

                    switch ($person->getUser->{Model::$USER_CATEGORY}) {

                        case RoleTrait::$CATEGORY_CUSTOMER_COMPANY:
                            return '';

                        default:
                        case RoleTrait::$CATEGORY_CUSTOMER_PARENT:
                            return $person->getUser->getCustomer->getStudents->count() > 0 ? __('Hoi! Ik ben :first_name en ik ben de ouder/verzorger van :students_text.', ['first_name' => $person->{Model::$PERSON_FIRST_NAME}, 'students_text' => CustomerTrait::getStudentsText($person->getUser->getCustomer, true)]) : __('Hoi! Ik ben een ouder/verzorger en mijn kinderen hebben hopelijk snel begeleiding bij Studied!');
                    }
            }
        }

        return '';
    }



    public static function getPrefixData() {

        return [
            __("meneer"),
            __("mevrouw")
        ];
    }



    public static function getReferData() {

        return [
            __("Promotie op social-media, zoals Instagram en Facebook"),
            __("Promotie in mijn stad, zoals posters en flyers"),
            __("Door te zoeken op internet, bijvoorbeeld met Google"),
            __("Op aanraden van een vakdocent"),
            __("Op aanraden van een kennis"),
            __("Ik heb al eerder gebruik gemaakt van jullie begeleiding, bijvoorbeeld voor mijn andere zoon/dochter")
        ];
    }



    public static function isUser($person) {

        return $person->getUser != null;

    }



    public static function isCompany($person) {

        return PersonTrait::isUser($person) && $person->getUser->role == RoleTrait::$ID_CUSTOMER && $person->getUser->{Model::$USER_CATEGORY} == RoleTrait::$CATEGORY_CUSTOMER_COMPANY;

    }





}
