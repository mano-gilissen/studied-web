<?php



namespace App\Http\Controllers;

use App\Http\Traits\UserTrait;
use App\Http\Support\Views;
use Illuminate\Http\Request;
use Auth;



class DebugController extends Controller {



    use UserTrait;



    public function view() {

        return view(
            Views::DEBUG,
            [
                UserTrait::$USER => Auth::user(),
                "bbb" => "aaa"
            ]);

    }



    public function landing() {

        return view(Views::LANDING);

    }



}
