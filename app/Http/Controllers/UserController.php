<?php



namespace App\Http\Controllers;
use App\Http\Support\Format;
use App\Http\Support\Key;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\UserTrait;
use App\Models\User;
use App\Http\Support\Views;
use App\Http\Support\Model;
use Illuminate\Http\Request;
use Auth;



class UserController extends Controller {



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

        if (UserTrait::isRegistered($user)) {

            $ac_data[UserTrait::$STATUS_ACTIVE]                             = UserTrait::getStatusText(UserTrait::$STATUS_ACTIVE);
            $ac_data[UserTrait::$STATUS_PASSIVE]                            = UserTrait::getStatusText(UserTrait::$STATUS_PASSIVE);
            $ac_data[UserTrait::$STATUS_ENDED]                              = UserTrait::getStatusText(UserTrait::$STATUS_ENDED);

        } else {

            $ac_data[UserTrait::$STATUS_INTAKE]                             = UserTrait::getStatusText(UserTrait::$STATUS_INTAKE);

        }

        $data[Key::AUTOCOMPLETE_DATA . Model::$USER_STATUS]                 = Format::encode($ac_data);
    }





}
