<?php



namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Person;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\SubjectTrait;
use App\Http\Traits\UserTrait;
use App\Http\Support\Prefix;
use App\Http\Support\Views;
use Illuminate\Http\Request;
use Auth;



class DebugController extends Controller {



    use UserTrait;
    use PersonTrait;



    public function view() {

        return view(
            Views::DEBUG, [
                UserTrait::$USER                            => Auth::user(),
                Prefix::AUTOCOMPLETE_DATA.'vak'             => implode('::', Subject::all()->pluck(SubjectTrait::$SUBJECT_DESCRIPTION)->toArray()),
                Prefix::AUTOCOMPLETE_DATA.'onderwerp'       => implode('::', Person::all()->pluck(PersonTrait::$PERSON_FIRST_NAME)->toArray())
            ]);

    }



    public function landing() {

        return view(Views::LANDING);

    }



}
