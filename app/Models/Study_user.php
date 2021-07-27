<?php



namespace App\Models;

use App\Http\Support\Model;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Study_user extends ModelClass {



    use SoftDeletes;



    protected

        $table                                  = 'study_user';



}
