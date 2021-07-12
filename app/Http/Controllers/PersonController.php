<?php



namespace App\Http\Controllers;

use App\Http\Traits\BaseTrait;
use App\Models\Person;
use App\Http\Support\Views;
use Illuminate\Http\Request;
use Auth;



class PersonController extends Controller {



    use BaseTrait;



    public function profile($slug = null) {

        if (!$slug) {

            $slug = Auth::user()->{self::$PERSON_SLUG};

        }

        $person = Person::where(self::$PERSON_SLUG, $slug)->firstOrFail();

        return '<img style="width:200px;height:200px" src="/storage/avatar/' . $person->avatar . '"/>';

        return view(Views::PROFILE, [
            self::$PERSON                                                   => $person
        ]);
    }



}
