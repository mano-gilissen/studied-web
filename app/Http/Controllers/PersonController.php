<?php



namespace App\Http\Controllers;

use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Models\Person;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use Illuminate\Http\Request;
use Auth;



class PersonController extends Controller {



    use BaseTrait;



    public function self() {

        $person                                     = Auth::user()->getPerson;

        return view(Views::PROFILE, [

            Model::$PERSON                          => $person,

            Key::PAGE_TITLE                         =>'Profielpagina',
            Key::PAGE_BACK                          => false,
            Key::COMMENT                            => PersonTrait::getProfileComment($person)
        ]);
    }



    public function view($slug) {

        $person                                     = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();

        return view(Views::PROFILE, [

            Model::$PERSON                          => $person,

            Key::PAGE_TITLE                         =>'Profielpagina',
            Key::PAGE_BACK                          => false,
            Key::COMMENT                            => PersonTrait::getProfileComment($person)
        ]);
    }



    public function edit($slug) {

        $person                                                             = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();

        $data                                                               = [];

        $data[Key::PAGE_TITLE]                                              = 'Persoon bewerken'; // TODO: ADD ROLE
        $data[Key::SUBMIT_ACTION]                                           = 'Opslaan';
        $data[Key::SUBMIT_ROUTE]                                            = 'person.edit_submit';

        $data[Model::$PERSON]                                               = $person;



        return view(Views::FORM_PERSON_EDIT, $data);
    }



    public function edit_submit(Request $request) {

        $data                                                               = $request->all();

        $person                                                             = Person::find($data['_' . Model::$PERSON]);

        self::edit_validate($data);

        // PersonTrait::update($data, $person);

        return redirect()->route('person.view', $person->{Model::$PERSON_SLUG});
    }



    public function edit_validate(array $data) {

        $rules                                                              = [];

        // TODO: ADD RULES

        $validator = Validator::make($data, $rules, self::getValidationMessages());

        $validator->validate();
    }



}
