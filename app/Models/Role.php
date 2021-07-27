<?php



namespace App\Models;

use App\Http\Support\Model;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Role extends ModelClass {



    use SoftDeletes;



    protected

        $table                                  = 'role';



}
