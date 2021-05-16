<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\UserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable {



    use Notifiable;
    use BaseTrait;
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



    public function getStudies() {

        return self::getOneToMany(self::$STUDY, self::$USER, self::$BASE_ID);

    }



}
