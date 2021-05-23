<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\UserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;



class User extends Authenticatable {



    use Notifiable;
    use SoftDeletes;
    use BaseTrait;
    use PersonTrait;
    use StudyTrait;
    use UserTrait;



    protected

        $table                                  = 'user',

        $fillable                               = [
            'name',
            'email',
            'password',
        ],

        $hidden                                 = [
            'password',
            'remember_token',
        ];



    public function getPerson() {

        return self::getOneToOne(self::$PERSON);

    }

    public function getStudies() {

        return self::getOneToMany(self::$STUDY, self::$STUDY_HOST_USER, self::$BASE_ID);

    }



}
