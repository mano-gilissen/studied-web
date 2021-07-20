<?php



namespace App\Http\Controllers;

use App\Http\Support\Table;
use App\Http\Traits\BaseTrait;
use Illuminate\Http\Request;
use Auth;



class LoadController extends Controller {



    use BaseTrait;



    public function list(Request $request) {

        return "a";
/*
        $data_type                                      = $request->input(Table::DATA_TYPE);

        return $data_type;

        switch($data_type) {

            case self::$STUDY:

                return redirect()->action([StudyController::class, 'list_load']);

            default:

                return "a";
        }*/
    }



}
