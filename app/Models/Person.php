<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;



class Person extends Model {



    use BaseTrait;



    protected

        $table                                  = 'person';



}
