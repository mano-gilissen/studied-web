<?php

namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Announcement extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'announcement';



}
