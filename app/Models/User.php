<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Auth;



class User extends Authenticatable {



    use Notifiable;
    use SoftDeletes;
    use BaseTrait;



    protected

        $table                                  = 'user',

        $fillable                               = ['name', 'email', 'password'],
        $hidden                                 = ['password', 'remember_token'];




    public function getPerson() {

        return self::getThisToOne(self::$PERSON);

    }



    public function getRole() {

        return self::getThisToOne(self::$ROLE);

    }



    public function isEmployee() {      return $this->{self::$ROLE} == self::$ID_EMPLOYEE;}

    public function isStudent() {       return $this->{self::$ROLE} == self::$ID_STUDENT;}

    public function isCustomer() {      return $this->{self::$ROLE} == self::$ID_CUSTOMER;}



    public function getEmployee() {

        return self::getOneToThis(self::$EMPLOYEE, self::$USER);

    }

    public function getStudent() {

        return self::getOneToThis(self::$STUDENT, self::$USER);

    }

    public function getCustomer() {

        return self::getOneToThis(self::$CUSTOMER, self::$USER);

    }



    public function hasStudies() {

        return $this->{self::$ROLE} != self::$ID_CUSTOMER;

    }

    public function getStudies() {

        switch ($this->{self::$ROLE}) {

            case self::$ID_CUSTOMER:
                return null;
            case self::$ID_STUDENT:
                return $this->getStudies_asParticipant();
            default:
                return $this->getStudies_asHost();
        }
    }

    public function getStudies_asHost() {

        return self::getOneToMany(self::$STUDY, self::$STUDY_HOST_USER);

    }

    public function getStudies_asParticipant() {

        return self::getManyToMany(self::$STUDY, self::$STUDY_USER, self::$USER);

    }



}
