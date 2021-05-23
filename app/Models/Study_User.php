<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Study_User extends Model {



    use SoftDeletes;



    protected

        $table                                  = 'study_user';



}
