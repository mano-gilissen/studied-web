<?php



namespace App\Http\Controllers\Auth;

use App\Http\Traits\LogTrait;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class LoginController extends Controller {



    use AuthenticatesUsers;
    use LogTrait;



    protected $redirectTo = RouteServiceProvider::HOME;



    public function __construct() {

        $this->middleware('guest')->except('logout');

    }



    public function view() {

        return view("auth.login");

    }



    protected function authenticated(Request $request, $user) {

        LogTrait::create(LogTrait::$ACTION_LOGIN);

    }



}
