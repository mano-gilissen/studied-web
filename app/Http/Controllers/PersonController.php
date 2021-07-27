<?php



namespace App\Http\Controllers;

use App\Http\Traits\BaseTrait;
use App\Models\Person;
use App\Http\Support\Views;
use App\Http\Support\Key;
use Illuminate\Http\Request;
use Auth;



class PersonController extends Controller {



    use BaseTrait;



    public function profile($slug) {

        $person = Person::where(self::$PERSON_SLUG, $slug)->firstOrFail();

        return view(Views::PROFILE, [

            self::$PERSON                                   => $person,
            Key::PAGE_BACK                                  => true,

            Key::COMMENT                                    => "\"Hoi ik ben een test comment voor de profielpagina van " . $person->{self::$PERSON_FIRST_NAME} . " " . $person->{self::$PERSON_LAST_NAME} . "\""
        ]);
    }



}
