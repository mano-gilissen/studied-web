<?php



namespace App\Http\Controllers;

use App\Http\Traits\BaseTrait;
use App\Models\Subject;
use App\Models\Person;
use App\Models\Study;
use App\Models\User;
use App\Http\Support\Key;
use App\Http\Support\Views;
use Illuminate\Http\Request;
use Auth;



class DebugController extends Controller {



    use BaseTrait;



    public function landing() {

        return view(Views::LANDING);

    }



    public function lab() {

        return view(
            Views::LAB, [

                Key::PAGE_TITLE                                             => 'The Lab',

                self::$USER                                                 => Auth::user()
            ]);
    }



    public function form_test() {

        // TODO: Create helper method to implode autocomplete data from database

        return view(Views::FORM_TEST, [

            Key::PAGE_TITLE                                                 => 'Formulier',
            Key::SUBMIT_ACTION                                              => 'Opslaan',

            Key::AUTOCOMPLETE_DATA.'field_autocomplete'                     => implode('::', Person::all()->pluck(self::$PERSON_FIRST_NAME)->toArray()),
            Key::AUTOCOMPLETE_DATA.'field_autocomplete_reject'              => implode('::', Subject::all()->pluck(self::$SUBJECT_DESCRIPTION)->toArray()),
            Key::AUTOCOMPLETE_DATA.'field_autocomplete_reject_show_all'     => implode('::', Subject::all()->pluck(self::$SUBJECT_DESCRIPTION)->toArray()),

            self::$USER                                                     => Auth::user()
        ]);
    }



    public function study_test() {

        $study = Study::first();

        return view(Views::STUDY, [

            Key::PAGE_TITLE                                                 => $study->getService->{self::$SERVICE_NAME},

            self::$STUDY                                                    => $study,
            'participants'                                                  => [User::find(1), User::find(2), User::find(3)],
            'button_contact_host'                                           => true,
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
