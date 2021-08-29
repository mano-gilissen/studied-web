<?php



namespace App\Http\Controllers;

use App\Http\Traits\BaseTrait;
use App\Models\Agreement;
use App\Http\Support\Views;
use App\Http\Support\Key;
use App\Http\Support\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;



class AgreementController extends Controller {





    use BaseTrait;





    public function view($key) {

        $agreement                                                         = Agreement::where(Model::$BASE_KEY, $key)->firstOrFail();

        return view(Views::AGREEMENT, [

            Key::PAGE_TITLE                                                 => 'Vakafspraak',
            Key::PAGE_BACK                                                  => true,

            Model::$AGREEMENT                                               => $agreement
        ]);
    }





}
