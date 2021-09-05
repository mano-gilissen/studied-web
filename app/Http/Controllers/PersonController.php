<?php



namespace App\Http\Controllers;

use App\Http\Support\Func;
use App\Http\Support\Route;
use App\Http\Traits\AddressTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\UserTrait;
use App\Models\Person;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Models\Study;
use Illuminate\Http\Request;
use Auth;



class PersonController extends Controller {





    use BaseTrait;





    public function self() {

        $person                                                             = Auth::user()->getPerson;

        return view(Views::PROFILE, [

            Model::$PERSON                                                  => $person,

            Key::PAGE_TITLE                                                 =>'Profielpagina',
            Key::PAGE_BACK                                                  => false,
            Key::COMMENT                                                    => PersonTrait::getProfileComment($person)
        ]);
    }





    public function view($slug) {

        $person                                                             = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();

        return view(Views::PROFILE, [

            Model::$PERSON                                                  => $person,

            Key::PAGE_TITLE                                                 =>'Profielpagina',
            Key::PAGE_BACK                                                  => false,
            Key::COMMENT                                                    => PersonTrait::getProfileComment($person)
        ]);
    }





    public function edit($slug) {

        $person                                                             = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();

        if (PersonTrait::isUser($person)) {

            switch ($person->getUser->role) {

                case RoleTrait::$ID_ADMINISTRATOR:
                case RoleTrait::$ID_BOARD:
                case RoleTrait::$ID_MANAGEMENT:
                case RoleTrait::$ID_EMPLOYEE:
                    return redirect()->route(Route::EMPLOYEE_EDIT, [Model::$PERSON_SLUG => $slug]);

                case RoleTrait::$ID_STUDENT:
                    return redirect()->route(Route::STUDENT_EDIT, [Model::$PERSON_SLUG => $slug]);

                case RoleTrait::$ID_CUSTOMER:
                    return redirect()->route(Route::CUSTOMER_EDIT, [Model::$PERSON_SLUG => $slug]);
            }

        } else {

            // TODO: ADD RELATION AND PARTICIPANT

        }
    }





    public function delete($slug) {

        $person                                                             = Person::where(Model::$PERSON_SLUG, $slug)->firstOrFail();

        if ($person->getUser->role == RoleTrait::$ID_BOARD || $person->getUser->role == RoleTrait::$ID_ADMINISTRATOR) {

            return redirect()->route(Route::EMPLOYEE_LIST);

        }

        if (PersonTrait::isUser($person)) {

            $person->getAddress                                             ->delete();
            $person->getUser                                                ->delete();
            $person                                                         ->delete();

            switch ($person->getUser->role) {

                case RoleTrait::$ID_MANAGEMENT:
                case RoleTrait::$ID_EMPLOYEE:

                    $person->getUser->getEmployee                           ->delete();

                    return redirect()->route(Route::EMPLOYEE_LIST);

                case RoleTrait::$ID_STUDENT:

                    $person->getUser->getStudent                            ->delete();

                    return redirect()->route(Route::STUDENT_LIST);

                case RoleTrait::$ID_CUSTOMER:

                    $person->getUser->getCustomer                           ->delete();

                    return redirect()->route(Route::CUSTOMER_LIST);
            }

        } else {

            // TODO: ADD RELATION AND PARTICIPANT

        }
    }





}
