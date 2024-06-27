<?php



namespace App\Http\Controllers;

use App\Http\Support\Files;
use App\Http\Support\Format;
use App\Http\Support\Func;
use App\Http\Support\Mail;
use App\Http\Support\Route;
use App\Http\Traits\AddressTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\UserTrait;
use App\Models\Employee;
use App\Models\Person;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Study;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;



class PersonController extends Controller {





    use BaseTrait;





    public function self() {

        $person                                                     = Auth::user()->getPerson;

        return view(Views::PROFILE, [

            Model::$PERSON                                          => $person,

            Key::PAGE_TITLE                                         => __('Profielpagina'),
            Key::PAGE_BACK                                          => false,
            Key::COMMENT                                            => PersonTrait::getProfileComment($person)
        ]);
    }





    public function view($slug) {

        $person                                                     = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();

        return view(Views::PROFILE, [

            Model::$PERSON                                          => $person,

            Key::PAGE_TITLE                                         => __('Profielpagina'),
            Key::PAGE_BACK                                          => false,
            Key::COMMENT                                            => PersonTrait::getProfileComment($person)
        ]);
    }





    public function edit($slug) {

        $person                                                     = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();

        if (PersonTrait::isUser($person)) {

            switch ($person->getUser->role) {

                case RoleTrait::$ID_ADMINISTRATOR:
                case RoleTrait::$ID_BOARD:
                case RoleTrait::$ID_MANAGEMENT:
                case RoleTrait::$ID_EMPLOYEE:
                    return redirect()->route(Route::EMPLOYEE_EDIT, [Model::$PERSON_SLUG => $slug]);

                case RoleTrait::$ID_STUDENT:
                    return redirect()->route(Route::STUDENT_EDIT, [Model::$PERSON_SLUG => $slug]);

                case RoleTrait::$ID_CUSTOMER:
                    return redirect()->route(Route::CUSTOMER_EDIT, [Model::$PERSON_SLUG => $slug]);
            }

        } else {

            // TODO: ADD RELATION AND PARTICIPANT

        }
    }





    public function delete($slug) {

        $person                                                     = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();

        if ($person->getUser->role == RoleTrait::$ID_BOARD || $person->getUser->role == RoleTrait::$ID_ADMINISTRATOR) {

            return redirect()->route(Route::EMPLOYEE_LIST);

        }

        if (PersonTrait::isUser($person)) {

            $redirect;

            switch ($person->getUser->role) {

                case RoleTrait::$ID_MANAGEMENT:
                case RoleTrait::$ID_EMPLOYEE:

                    foreach ($person->getUser->getStudies as $study) {

                        $study                                      ->delete();

                    }

                    $person->getUser->getEmployee                   ->delete();
                    $redirect                                       = Route::EMPLOYEE_LIST;
                    break;

                case RoleTrait::$ID_STUDENT:

                    foreach ($person->getUser->getStudies as $study) {

                        $study                                      ->delete();

                    }

                    $person->getUser->getStudent                    ->delete();
                    $redirect                                       = Route::STUDENT_LIST;
                    break;

                case RoleTrait::$ID_CUSTOMER:

                    $person->getUser->getCustomer                   ->delete();
                    $redirect                                       = Route::CUSTOMER_LIST;
                    break;
            }

            $person->getAddress                                     ->delete();
            $person->getUser                                        ->delete();
            $person                                                 ->delete();

            return redirect()->route($redirect);

        } else {

            // TODO: ADD RELATION AND PARTICIPANT

        }
    }





    public function activate($slug) {

        $user                                                       = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail()->getUser;

        if (!$user || UserTrait::isActivated($user)) {

            abort(404);

        }

        switch ($user->role) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_EMPLOYEE:
                Mail::userActivate_forEmployee($user);
                break;

            case RoleTrait::$ID_STUDENT:
                Mail::userActivate_forStudent_noStudy($user);
                break;

            case RoleTrait::$ID_CUSTOMER:
                Mail::userActivate_forCustomer_noStudy($user);
                break;
        }


        return view(Views::FEEDBACK, [

            Key::PAGE_TITLE                                         => __('Mail verstuurd'),
            Key::PAGE_NEXT                                          => route('person.view', [Model::$PERSON_SLUG => $slug]),
            Key::PAGE_ACTION                                        => __('Terug'),
            Key::ICON                                               => 'check-circle-green.svg'
        ]);
    }




    public static function form_set_ac_data_refer(&$data) {

        $data[Key::AUTOCOMPLETE_DATA . Model::$PERSON_REFER]        = Format::encode(PersonTrait::getReferData());

    }





    public function avatar_submit(Request $request) {

        $user                                                       = User::findOrFail($request->{Model::$USER});
        $person                                                     = $user->getPerson;

        if ($user->{Model::$BASE_ID} != Auth::id() && !BaseTrait::hasBoardRights()) {

            abort(403);

        }

        $image_parts                                                = explode(";base64,", $request->image);
        $image_base64                                               = base64_decode($image_parts[1]);
        $file_name                                                  = "avatar_" . $user->{Model::$BASE_ID} . "_" . time() . ".png";

        file_put_contents(public_path() . Files::LOCATION_AVATAR . $file_name, $image_base64);

        $person->{Model::$PERSON_AVATAR}                            = $file_name;
        $person->save();

        return response()->json(['file_name' => $file_name]);
    }





}
