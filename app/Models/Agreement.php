<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Agreement extends Model {



    use SoftDeletes;



    protected

        $table                                  = 'agreement';



}
