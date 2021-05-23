<?php



namespace App\Http\Controllers;

use App\Http\Traits\UserTrait;
use App\Http\Support\Views;
use Illuminate\Http\Request;
use Auth;



class HomeController extends Controller {



    use UserTrait;



    public function view() {

        return view(Views::HOME, [UserTrait::$USER => Auth::user()]);

    }



    public function landing() {

        return view(Views::LANDING);

    }



}
