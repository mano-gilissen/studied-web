<?php



namespace App\Http\Controllers;

use App\Models\Person;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\SubjectTrait;
use App\Http\Traits\UserTrait;
use App\Http\Support\Views;
use Illuminate\Http\Request;
use Auth;



class DebugController extends Controller {



    use UserTrait;
    use PersonTrait;



    public function view() {

        return view(
            Views::DEBUG,
            [
                UserTrait::$USER => Auth::user(),
                "ac_data_vak" => implode('::', Person::all()->pluck(SubjectTrait::$SUBJECT_CODE)->toArray())
            ]);

    }



    public function landing() {

        return view(Views::LANDING);

    }



}
