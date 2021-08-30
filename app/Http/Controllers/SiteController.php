<?php



namespace App\Http\Controllers;



class SiteController extends Controller {



    public function home() {

        return \File::get(public_path() . '/home.html');

    }



    public function actueel() {

        return \File::get(public_path() . '/actueel.html');

    }



    public function artikel() {

        return \File::get(public_path() . '/artikel.html');

    }



    public function begeleiding() {

        return \File::get(public_path() . '/begeleiding.html');

    }



    public function werk() {

        return \File::get(public_path() . '/werk.html');

    }



    public function werkwijze() {

        return \File::get(public_path() . '/werkwijze.html');

    }



    public function zakelijk() {

        return \File::get(public_path() . '/zakelijk.html');

    }



}
