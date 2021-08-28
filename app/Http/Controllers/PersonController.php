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

            Key::PAGE_BACK                          => false,
            Key::COMMENT                            => PersonTrait::getProfileComment($person)
        ]);
    }



    public function view($slug) {

        $person                                     = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();

        return view(Views::PROFILE, [

            Model::$PERSON                          => $person,

            Key::PAGE_BACK                          => false,
            Key::COMMENT                            => PersonTrait::getProfileComment($person)
        ]);
    }



}
