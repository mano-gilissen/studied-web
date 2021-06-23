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



    public function lab() {

        return view(
            Views::LAB, [

                Form::PAGE_TITLE                            => 'The lab',
                UserTrait::$USER                            => Auth::user()
            ]);

    }



    public function landing() {

        return view(Views::LANDING);
    }



    public function form_test() {

        // TODO: Create helper method to implode autocomplete data from database

        return view(Views::FORM_TEST, [

            UserTrait::$USER                                                => Auth::user(),
            Form::PAGE_TITLE                                                => 'Test formulier',
            Form::SUBMIT_ACTION                                             => 'Opslaan',

            Form::AUTOCOMPLETE_DATA.'field_autocomplete'                    => implode('::', Person::all()->pluck(PersonTrait::$PERSON_FIRST_NAME)->toArray()),
            Form::AUTOCOMPLETE_DATA.'field_autocomplete_reject'             => implode('::', Subject::all()->pluck(SubjectTrait::$SUBJECT_DESCRIPTION)->toArray()),
            Form::AUTOCOMPLETE_DATA.'field_autocomplete_reject_show_all'    => implode('::', Subject::all()->pluck(SubjectTrait::$SUBJECT_DESCRIPTION)->toArray())
        ]);
    }



    public function study_test() {

        return view(Views::STUDY, [

            Form::PAGE_TITLE                                                => 'Privéles'

        ]);
    }



}





/*

    public function avatar_submit(Request $request) {

        $redirect                           = $request->all()['redirect'];

        $image_parts                        = explode(";base64,", $request->image);
        $image_type_aux                     = explode("image/", $image_parts[0]);
        $image_base64                       = base64_decode($image_parts[1]);
        $file_name                          = "avatar_" . Auth::user()->id . "_" . time() . ".jpeg";

        file_put_contents(public_path() . "/storage/avatar/" . $file_name, $image_base64);

        self::avatar_set($file_name);

        return response()->json(['url' => route($redirect)]);
    }



    public function avatar_validate($data) {

        $messages = [
            'avatar.max'                        => 'Deze afbeelding is te groot (Max 10Mb), probeer het opnieuw.',
            'avatar.mimes'                      => 'De avatar moet een afbeelding zijn. Probeer het opnieuw.'
        ];

        $validator = Validator::make($data, [
            'avatar'                            => ['required', 'mimes:jpeg,jpg,png,gif', 'max:10000'],
        ], $messages);

        $validator->validate();
    }

*/
