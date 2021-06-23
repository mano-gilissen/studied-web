<?php



namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Person;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\SubjectTrait;
use App\Http\Traits\UserTrait;
use App\Http\Support\Form;
use App\Http\Support\Views;
use Illuminate\Http\Request;
use Auth;



class DebugController extends Controller {



    use UserTrait;
    use PersonTrait;



    public function debug() {

        return view(
            Views::DEBUG, [
                UserTrait::$USER                            => Auth::user()
            ]);

    }



    public function landing() {

        return view(Views::LANDING);

    }



    public function form_test() {

        // TODO: Create helper method to implode autocomplete data from database
        // TODO: Create (Vue) template for Auth::user() display view top right

        return view(Views::FORM_TEST, [

            UserTrait::$USER                                                => Auth::user(),
            Form::PAGE_TITLE                                                => 'Test formulier',
            Form::SUBMIT_ACTION                                             => 'Opslaan',

            Form::AUTOCOMPLETE_DATA.'field_autocomplete'                    => implode('::', Person::all()->pluck(PersonTrait::$PERSON_FIRST_NAME)->toArray()),
            Form::AUTOCOMPLETE_DATA.'field_autocomplete_reject'             => implode('::', Subject::all()->pluck(SubjectTrait::$SUBJECT_DESCRIPTION)->toArray()),
            Form::AUTOCOMPLETE_DATA.'field_autocomplete_reject_show_all'    => implode('::', Subject::all()->pluck(SubjectTrait::$SUBJECT_DESCRIPTION)->toArray())
        ]);

    }



}
