<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\PersonTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Level extends ModelClass {



    use SoftDeletes;



    protected

        $table                                  = 'level';



    public function getWithYearAttribute() {

        return $this->{Model::$LEVEL_NAME} . ' ' . $this->{Model::$LEVEL_YEAR};

    }



}
