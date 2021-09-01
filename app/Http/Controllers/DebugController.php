<?php



namespace App\Http\Controllers;

use App\Http\Mail\Study_Planned;
use App\Models\Subject;
use App\Models\Person;
use App\Http\Support\Key;
use App\Http\Support\Views;
use App\Http\Support\Format;
use Illuminate\Http\Request;
use App\Http\Support\Model;
use Auth;



class DebugController extends Controller {





    public function landing() {

        return view(Views::LANDING);

    }



    public function lab() {

        return view(
            Views::LAB, [

                Key::PAGE_TITLE                                             => 'The Lab',

                Model::$USER                                                => Auth::user()
            ]);
    }



    public function template() {

        return view(
            'template', [

        ]);
    }



    public function form_test() {

        // TODO: Create helper method to implode autocomplete data from database

        return view(Views::FORM_TEST, [

            Key::PAGE_TITLE                                                 => 'Formulier',
            Key::SUBMIT_ACTION                                              => 'Opslaan',

            Key::AUTOCOMPLETE_DATA.'field_autocomplete'                     => Format::ac(Person::all()->pluck(Model::$PERSON_FIRST_NAME)->toArray()),
            Key::AUTOCOMPLETE_DATA.'field_autocomplete_reject'              => Format::ac(Subject::all()->pluck(Model::$SUBJECT_SHORT)->toArray()),
            Key::AUTOCOMPLETE_DATA.'field_autocomplete_reject_show_all'     => Format::ac(Subject::all()->pluck(Model::$SUBJECT_SHORT)->toArray())
        ]);
    }



    public function mail_test($slug) {

        $person                             = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();
        $mail                               = new Study_Planned($person);

        Mail::to($person->getUser->{Model::$USER_EMAIL})->send($mail);
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
