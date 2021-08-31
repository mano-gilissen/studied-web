<?php



namespace App\Http\Controllers;



use App\Http\Support\Key;
use App\Http\Support\Model;
use App\Http\Support\Views;
use App\Http\Traits\PersonTrait;
use App\Models\Article;

class SiteController extends Controller {



    public function home() {

        return \File::get(public_path() . '/home.html');

    }



    public function actueel() {

        return view(Views::WEBSITE_ACTUEEL);

    }



    public function artikel($id) {

        return view(Views::WEBSITE_ARTIKEL, ['article', Article::findOrFail($id)]);

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
