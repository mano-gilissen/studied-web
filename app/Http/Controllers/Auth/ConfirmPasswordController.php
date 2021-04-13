<?php



namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPassword;



class ConfirmPasswordController extends Controller {



    use ConfirmsPassword;



    protected $redirectTo = RouteServiceProvider::HOME;



    public function __construct() {

        $this->middleware('auth');
    }


}
