<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Invoice extends ModelClass {



    use SoftDeletes;



    protected

        $table                                  = 'invoice';



}
