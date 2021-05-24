<?php



namespace App\Http\Controllers;

use App\Http\Traits\UserTrait;
use App\Http\Support\Views;
use Illuminate\Http\Request;
use Auth;



class TestController extends Controller {



    use UserTrait;



    public function view() {

        return view(Views::TEST, [UserTrait::$USER => Auth::user()]);

    }



    public function landing() {

        return view(Views::LANDING);

    }



}
