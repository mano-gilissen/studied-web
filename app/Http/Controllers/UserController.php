<?php



namespace App\Http\Controllers;

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



}
