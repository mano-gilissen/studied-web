<?php



namespace App\Http\Traits;

use App\Http\Support\Color;
use App\Http\Support\Format;
use App\Http\Support\Key;
use App\Http\Support\Mail;
use App\Http\Support\Model;
use App\Models\Agreement;
use App\Models\Evaluation;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;



trait UserTrait {





    public static

        $STATUS_INTAKE                                      = 1,
        $STATUS_ACTIVE                                      = 2,
        $STATUS_PASSIVE                                     = 3,
        $STATUS_ENDED                                       = 4;





    public static function create($data, $role, $status = null) {

        self::validate($data);

        $user                                               = new User;
        $person                                             = PersonTrait::create($data);
        $address                                            = AddressTrait::create($data);

        if (!$person || !$address) {

            return false;

        }

        $user->{Model::$PERSON}                             = $person->{Model::$BASE_ID};
        $person->{Model::$ADDRESS}                          = $address->{Model::$BASE_ID};

        $user->{Model::$USER_EMAIL}                         = $data[Model::$USER_EMAIL];
        $user->{Model::$ROLE}                               = $role;
        $user->{Model::$USER_STATUS}                        = $status ? $status : self::$STATUS_ACTIVE;

        $user->save();
        $person->save();
        $address->save();

        return $user;
    }



    public static function update($data, $user) {

        self::validate($data, $user);

        PersonTrait::update($data, $user->getPerson);
        AddressTrait::update($data, $user->getPerson->getAddress);

        $user->{Model::$USER_EMAIL}                         = $data[Model::$USER_EMAIL];
        $user->{Model::$USER_STATUS}                        = $data[Key::AUTOCOMPLETE_ID . Model::$USER_STATUS];

        $user->save();

        return $user;
    }



    public static function validate(array $data, $user = null) {

        $rules                                                              = [];

        if ($user) {

            $rules[Model::$USER_EMAIL]                                      = ['required', 'email', Rule::unique('user')->ignore($user)];

        } else {

            $rules[Model::$USER_EMAIL]                                      = ['required', 'email', 'unique:user,email'];

        }

        $validator                                                          = Validator::make($data, $rules, BaseTrait::getValidationMessages());

        $validator->validate();
    }



    public static function activate($data, &$user) {

        $user->{Model::$USER_PASSWORD}                                      = Hash::make($data['password']);
        $user->{Model::$USER_STATUS}                                        = UserTrait::$STATUS_ACTIVE;
        $user->{Model::$USER_ACTIVATED}                                     = Carbon::now();

        $user->save();
    }



    public static function password_set($data) {

        Auth::user()->{Model::$USER_PASSWORD}                               = Hash::make($data['password']);
        Auth::user()->save();
    }





    public static function getRoleName($user, $public = false) {

        $role                                               = $user->getRole;

        if (!$role) {

            return false;

        }

        return $public ? $role->{Model::$ROLE_LABEL_PUBLIC} : $role->{Model::$ROLE_LABEL};
    }



    public static function getAgreements($user, $active_only = false, $include_trial = true, $include_finished = false) {

        $query                                              = Agreement::query();

        switch ($user->{Model::$ROLE}) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_EMPLOYEE:
                $query->where(Model::$EMPLOYEE, $user->{Model::$BASE_ID});
                break;

            case RoleTrait::$ID_STUDENT:
                $query->where(Model::$STUDENT, $user->{Model::$BASE_ID});
                break;
        }

        if ($active_only) {

            $query->where(Model::$AGREEMENT_END, '>', date(Format::$DATABASE_DATETIME, time()));

        }

        if (!$include_trial) {

            $query->where(Model::$AGREEMENT_STATUS, '!=', AgreementTrait::$STATUS_UNAPPROVED);

        }

        if (!$include_finished) {

            $query->where(Model::$AGREEMENT_STATUS, '!=', AgreementTrait::$STATUS_FINISHED);

        }

        return $query->get()->sortByDesc(Model::$SUBJECT);
    }



    public static function getEvaluations($user) {

        switch ($user->{Model::$ROLE}) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_EMPLOYEE:

                return Evaluation::where(Model::$EVALUATION_HOST, $user->id)

                    ->orWhereHas('getEmployees', function ($query) use ($user) {

                        $query->where(Model::$BASE_ID, $user->id);

                    })->get()->sortByDesc(Model::$BASE_CREATED_AT);

            case RoleTrait::$ID_STUDENT:

                return $user->getEvaluations_asStudent->sortByDesc(Model::$BASE_CREATED_AT);

            case RoleTrait::$ID_CUSTOMER:

                return Evaluation::whereHas('getStudent.getStudent', function ($query) use ($user) {

                    $query->where(Model::$CUSTOMER, $user->getCustomer->id);

                })->get()->sortByDesc(Model::$BASE_CREATED_AT);
        }

        return null;
    }



    public static function isActivated($user) {

        return $user->{Model::$USER_STATUS} != self::$STATUS_INTAKE;

    }



    public static function sentActivation($user) {

        return $user->{Model::$USER_ACTIVATE_SECRET};

    }



    public static function getStatusText($status) {

        switch ($status) {

            case self::$STATUS_INTAKE:                      return "Intake";
            case self::$STATUS_ACTIVE:                      return "Actief";
            case self::$STATUS_PASSIVE:                     return "Passief";
            case self::$STATUS_ENDED:                       return "Beëindigd";
            default:                                        return Key::UNKNOWN;
        }
    }



    public static function getStatusColor($status) {

        switch ($status) {

            case self::$STATUS_INTAKE:
            case self::$STATUS_PASSIVE:                     return Color::ORANGE;
            case self::$STATUS_ACTIVE:                      return Color::GREEN;
            case self::$STATUS_ENDED:
            default:                                        return Color::RED;
        }
    }



    public static function getStatusTextColor($status) {

        switch ($status) {

            case self::$STATUS_INTAKE:
            case self::$STATUS_ACTIVE:
            case self::$STATUS_PASSIVE:
            case self::$STATUS_ENDED:
            default:                                        return Color::WHITE;
        }
    }



    public static function getStatusFilterData() {

        return [
            self::$STATUS_INTAKE                            => self::getStatusText(self::$STATUS_INTAKE),
            self::$STATUS_ACTIVE                            => self::getStatusText(self::$STATUS_ACTIVE),
            self::$STATUS_PASSIVE                           => self::getStatusText(self::$STATUS_PASSIVE),
            self::$STATUS_ENDED                             => self::getStatusText(self::$STATUS_ENDED)
        ];
    }





}
