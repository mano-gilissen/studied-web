<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Log extends Model {



    use SoftDeletes;
    use BaseTrait;



    protected

        $table                                  = 'log';



}
