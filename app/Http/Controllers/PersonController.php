<?php



namespace App\Http\Controllers;

use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Models\Person;
use App\Http\Support\Views;
use App\Http\Support\Key;
use Illuminate\Http\Request;
use Auth;



class PersonController extends Controller {



    use BaseTrait;



    public function self() {

        $person                                     = Auth::user()->getPerson;

        return view(Views::PROFILE, [

            self::$PERSON                           => $person,

            Key::PAGE_BACK                          => false,
            Key::COMMENT                            => PersonTrait::getProfileComment($person)
        ]);
    }



    public function view($slug) {

        $person                                     = Person::where(self::$PERSON_SLUG, $slug)->firstOrFail();

        return view(Views::PROFILE, [

            self::$PERSON                           => $person,

            Key::PAGE_BACK                          => true,
            Key::COMMENT                            => PersonTrait::getProfileComment($person)
        ]);
    }



}
