<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;



class HomeController extends Controller {



    public function view() {

        return view('home', ['user' => Auth::user()]);

    }



    public function landing() {

        return view('landing');

    }



}
