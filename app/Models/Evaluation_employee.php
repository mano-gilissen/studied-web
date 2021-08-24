<?php



namespace App\Models;

use App\Http\Support\Model;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Evaluation_employee extends ModelClass {



    use SoftDeletes;



    protected

        $table                                  = 'evaluation_employee';



}
