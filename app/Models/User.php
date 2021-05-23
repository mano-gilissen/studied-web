<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use App\Http\Traits\PersonTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\UserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;



class User extends Authenticatable {



    use Notifiable;
    use SoftDeletes;
    use BaseTrait;
    use PersonTrait;
    use RoleTrait;
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



    /**   TODO: REVISE   */
    public function getRoleObject() {

        switch ($this->{UserTrait::$USER_ROLE}) {

            case RoleTrait::$ID_ADMINISTRATOR:
            case RoleTrait::$ID_BOARD:
            case RoleTrait::$ID_MANAGEMENT:
            case RoleTrait::$ID_EMPLOYEE:
                return Employee::find(Auth::id());

            case RoleTrait::$ID_STUDENT:
                return Student::find(Auth::id());

            case RoleTrait::$ID_CUSTOMER:
                return Customer::find(Auth::id());

            default:
                return null;

        }
    }

    public function getPerson() {

        return self::getOneToOne(self::$PERSON);

    }

    public function getStudies() {

        return self::getOneToMany(self::$STUDY, self::$STUDY_HOST_USER, self::$BASE_ID);

    }



}
