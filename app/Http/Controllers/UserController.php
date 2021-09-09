<?php



namespace App\Http\Controllers;
use App\Http\Support\Format;
use App\Http\Support\Key;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\EmployeeTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\UserTrait;
use App\Models\User;
use App\Http\Support\Views;
use App\Http\Support\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;



class UserController extends Controller {





    public function activate($secret) {

        if (Auth::check()) {

            Auth::logout();

        }

        $user                                               = User::where(Model::$USER_ACTIVATE_SECRET, $secret)->firstOrFail();

        return view(Views::ACTIVATE, [

            Model::$USER                                    => $user,

            Key::PAGE_TITLE                                 =>'Profiel activeren',
            Key::NAVIGATION                                 => false,
        ]);
    }



    public function activate_submit(Request $request) {

        $data                                               = $request->all();
        $user                                               = User::findOrFail($data[Key::AUTOCOMPLETE_ID .  Model::$USER]);

        self::password_validate($data);

        UserTrait::activate($data, $user);

        Auth::guard()->login($user);

        if (BaseTrait::hasEmployeeRights()) {

            EmployeeTrait::start_employment($user->getEmployee);

        }

        return view(Views::FEEDBACK, [

            Key::PAGE_TITLE                                 => 'Account geactiveerd',
            Key::PAGE_MESSAGE                               => 'Gefeliciteerd! Je Studied webportaal account is geactiveerd en klaar voor gebruik.',
            Key::PAGE_NEXT                                  => route('person.self'),
            Key::PAGE_ACTION                                => 'Naar mijn profiel',
            Key::ICON                                       => 'check-circle-green.svg'
        ]);
    }





    public function edit() {

        return view(Views::PROFILE_EDIT, [

            Key::PAGE_TITLE                                 => 'Profiel wijzigen',
            Key::PAGE_BACK                                  => true,
            Key::BACK_ROUTE                                 => 'person.self'
        ]);
    }



    public function password_submit(Request $request) {

        $data                                               = $request->all();

        self::password_validate($data);

        UserTrait::password_set($data);

        return view(Views::FEEDBACK, [

            Key::PAGE_TITLE                                 => 'Wachtwoord gewijzigd',
            Key::PAGE_MESSAGE                               => 'Je wachtwoord is gewijzigd, zorg dat je het goed onthoudt. Deel je inloggegevens nooit deelt met anderen.',
            Key::PAGE_NEXT                                  => route('person.self'),
            Key::PAGE_ACTION                                => 'Naar mijn profiel',
            Key::ICON                                       => 'check-circle-green.svg'
        ]);
    }



    public function password_validate(array $data) {

        $messages = [
            'password.required'                             => 'Vul een wachtwoord in.',
            'password.min'                                  => 'Het wachtwoord moet uit minimaal 8 characters bestaan.',
            'password.confirmed'                            => 'Het wachtwoord komt niet overeen, probeer het opnieuw.'
        ];

        $validator = Validator::make($data, [
            'password'                                      => ['bail', 'required', 'string', 'min:8', 'confirmed'],
        ], $messages);

        $validator->validate();
    }





    public function form_study_agreements_load(Request $request) {

        $user_id                                            = $request->input(Model::$USER, null);
        $user                                               = null;

        if ($user_id > 0) {

            $user                                           = User::find($user_id);

        }

        return view(Views::LOAD_AGREEMENTS, [

            Model::$USER                                    => $user

        ]);
    }



    public static function form_set_ac_data_status(&$data, $user) {

        $ac_data                                                            = [];

        if (UserTrait::isActivated($user)) {

            $ac_data[UserTrait::$STATUS_ACTIVE]                             = UserTrait::getStatusText(UserTrait::$STATUS_ACTIVE);
            $ac_data[UserTrait::$STATUS_PASSIVE]                            = UserTrait::getStatusText(UserTrait::$STATUS_PASSIVE);
            $ac_data[UserTrait::$STATUS_ENDED]                              = UserTrait::getStatusText(UserTrait::$STATUS_ENDED);

        } else {

            $ac_data[UserTrait::$STATUS_INTAKE]                             = UserTrait::getStatusText(UserTrait::$STATUS_INTAKE);

        }

        $data[Key::AUTOCOMPLETE_DATA . Model::$USER_STATUS]                 = Format::encode($ac_data);
    }





}
