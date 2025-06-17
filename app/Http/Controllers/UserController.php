<?php



namespace App\Http\Controllers;
use App\Http\Middleware\Locale;
use App\Http\Support\Format;
use App\Http\Support\Func;
use App\Http\Support\Key;
use App\Http\Support\Mail;
use App\Http\Support\Route;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\EmployeeTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\UserTrait;
use App\Models\Person;
use App\Models\User;
use App\Http\Support\Views;
use App\Http\Support\Model;
use Couchbase\View;
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

            Key::PAGE_TITLE                                 => __('Profiel activeren'),
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

            Key::PAGE_TITLE                                 => __('Account geactiveerd'),
            Key::PAGE_MESSAGE                               => __('Gefeliciteerd! Je account is geactiveerd en klaar voor gebruik.'),
            Key::PAGE_NEXT                                  => route('person.self'),
            Key::PAGE_ACTION                                => __('Naar mijn profiel'),
            Key::ICON                                       => 'check-circle-green.svg'
        ]);
    }





    public function edit($slug = null) {

        dd('hallooo');

        if ($slug && !BaseTrait::hasBoardRights()) {

            abort(403);

        }

        return view(Views::PROFILE_EDIT, [

            Model::$USER                                    => $slug ? Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail()->getUser : Auth::user(),

            Key::PAGE_TITLE                                 => __('Profiel wijzigen'),
            Key::PAGE_BACK                                  => true
        ]);
    }



    public function password_submit(Request $request) {

        $data                                               = $request->all();
        $user                                               = $data['user'] ? User::findOrFail($data['user']) : Auth::user();

        if ($user->{Model::$BASE_ID} != Auth::id() && !BaseTrait::hasBoardRights()) {

            abort(403);

        }

        self::password_validate($data);

        UserTrait::password_set($data, $user);

        if ($user->{Model::$BASE_ID} == Auth::id()) {

            return view(Views::FEEDBACK, [

                Key::PAGE_TITLE                             => __('Wachtwoord gewijzigd'),
                Key::PAGE_MESSAGE                           => __('Je wachtwoord is gewijzigd, zorg dat je het goed onthoudt. Deel je inloggegevens nooit deelt met anderen.'),
                Key::PAGE_NEXT                              => route('person.self'),
                Key::PAGE_ACTION                            => __('Naar mijn profiel'),
                Key::ICON                                   => 'check-circle-green.svg'
            ]);

        } else {

            return view(Views::FEEDBACK, [

                Key::PAGE_TITLE                             => __('Wachtwoord gewijzigd'),
                Key::PAGE_MESSAGE                           => __('Het wachtwoord is gewijzigd.'),
                Key::PAGE_NEXT                              => route(Route::PERSON_VIEW, [Model::$PERSON_SLUG => $user->getPerson->{Model::$PERSON_SLUG}]),
                Key::PAGE_ACTION                            => __('Naar mijn profiel'),
                Key::ICON                                   => 'check-circle-green.svg'
            ]);
        }
    }



    public function password_validate(array $data) {

        $messages = [
            'password.required'                             => __('Vul een wachtwoord in.'),
            'password.min'                                  => __('Het wachtwoord moet uit minimaal 8 characters bestaan.'),
            'password.confirmed'                            => __('Het wachtwoord komt niet overeen, probeer het opnieuw.')
        ];

        $validator = Validator::make($data, [
            'password'                                      => ['bail', 'required', 'string', 'min:8', 'confirmed'],
        ], $messages);

        $validator->validate();
    }





    public function language_submit(Request $request) {

        $data                                               = $request->all();
        $language                                           = $data['value'];

        if (!in_array($language, Locale::getOptions())) {

            abort(403);

        }

        $user                                               = Auth::user();
        $user->{Model::$USER_LANGUAGE}                      = $language;
        $user->save();

        return $language;
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





    public static function scheduled_activation_reminder() {

        $users                                                              = User::where(Model::$USER_STATUS, UserTrait::$STATUS_INTAKE)->where(Model::$BASE_DELETED_AT, null)->get();
        $sent                                                               = [];

        foreach ($users as $user) {

            if (!$user->{Model::$USER_ACTIVATE_SECRET} || !$user->{Model::$USER_ACTIVATE_SENT}) {

                continue;

            }

            if (strpos($user->{Model::$USER_EMAIL}, '@studied.nl') !== false) {

                continue;

            }

            if (strtotime($user->{Model::$USER_ACTIVATE_SENT}) < strtotime('-2 week') && !$user->{Model::$USER_ACTIVATE_REMINDER_2WEEK}) {

                $user->{Model::$USER_ACTIVATE_REMINDER_2WEEK}               = true;
                $user->save();

                Mail::userActivate_reminder($user);

                $sent[]                                                     = $user->{Model::$USER_EMAIL};

                continue;
            }

            if (strtotime($user->{Model::$USER_ACTIVATE_SENT}) < strtotime('-1 week') && !$user->{Model::$USER_ACTIVATE_REMINDER_1WEEK} && !$user->{Model::$USER_ACTIVATE_REMINDER_2WEEK}) {

                $user->{Model::$USER_ACTIVATE_REMINDER_1WEEK}               = true;
                $user->save();

                Mail::userActivate_reminder($user);

                $sent[]                                                     = $user->{Model::$USER_EMAIL};
            }
        }

        return sizeof($sent) > 0 ? implode(', ', $sent) : null;
    }





}
