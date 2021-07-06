<?php



namespace App\Http\Controllers;

use App\Http\Traits\BaseTrait;
use App\Models\Study;
use App\Models\User;
use App\Http\Support\Key;
use App\Http\Support\Views;
use Illuminate\Http\Request;
use Auth;



class StudyController extends Controller {



    use BaseTrait;



    public function view($id) {

        $study = Study::findOrFail($id);

        return view(Views::STUDY, [

            Key::PAGE_TITLE                                                 => $study->getService->{self::$SERVICE_NAME},

            self::$STUDY                                                    => $study,
            'participants'                                                  => [User::find(1), User::find(3)],
            'button_contact_host'                                           => true,
        ]);
    }



}
