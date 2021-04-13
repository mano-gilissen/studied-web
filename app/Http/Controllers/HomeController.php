<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;



class HomeController extends Controller {



    public function home() {

        return view('home', ['user' => Auth::user()]);

    }



    public function landing() {

        return view('landing');

    }



}
