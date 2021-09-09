<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\AgreementTrait;
use App\Http\Traits\BaseTrait;
use App\Http\Traits\RoleTrait;
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

        return self::getThisToOne(Model::$PERSON);

    }



    public function getRole() {

        return self::getThisToOne(Model::$ROLE);

    }



    public function isEmployee() {      return $this->{Model::$ROLE} == RoleTrait::$ID_EMPLOYEE;}

    public function isStudent() {       return $this->{Model::$ROLE} == RoleTrait::$ID_STUDENT;}

    public function isCustomer() {      return $this->{Model::$ROLE} == RoleTrait::$ID_CUSTOMER;}



    public function getEmployee() {

        return self::getOneToThis(Model::$EMPLOYEE, Model::$USER);

    }

    public function getStudent() {

        return self::getOneToThis(Model::$STUDENT, Model::$USER);

    }

    public function getCustomer() {

        return self::getOneToThis(Model::$CUSTOMER, Model::$USER);

    }



    public function hasStudies() {

        return $this->{Model::$ROLE} != RoleTrait::$ID_CUSTOMER;

    }

    public function getStudies() {

        switch ($this->{Model::$ROLE}) {

            case RoleTrait::$ID_CUSTOMER:
                return null;
            case RoleTrait::$ID_STUDENT:
                return $this->getStudies_asParticipant();
            default:
                return $this->getStudies_asHost();
        }
    }

    public function getStudies_asHost() {

        return self::getOneToMany(Model::$STUDY, Model::$STUDY_HOST_USER);

    }

    public function getStudies_asParticipant() {

        return self::getManyToMany(Model::$STUDY, Model::$STUDY_USER, Model::$USER);

    }



    public function getAgreements_asEmployee() {

        return self::getOneToMany(Model::$AGREEMENT, Model::$EMPLOYEE);

    }

    public function getAgreements_asStudent() {

        return self::getOneToMany(Model::$AGREEMENT, Model::$STUDENT);

    }



    public function getEvaluations_asHost() {

        return self::getOneToMany(Model::$EVALUATION, Model::$EVALUATION_HOST);

    }

    public function getEvaluations_asEmployee() {

        return self::getManyToMany(Model::$EVALUATION, Model::$EVALUATION_EMPLOYEE, Model::$EMPLOYEE);

    }

    public function getEvaluations_asStudent() {

        return self::getOneToMany(Model::$EVALUATION, Model::$STUDENT);

    }



    public function getStudents() {

        return self::getManyToMany(Model::$USER, Model::$AGREEMENT, Model::$EMPLOYEE, MODEL::$STUDENT)->whereIn(Model::$AGREEMENT . '.' . Model::$AGREEMENT_STATUS, array(AgreementTrait::$STATUS_UNAPPROVED, AgreementTrait::$STATUS_ACTIVE))->distinct();

    }



    public function getEmployees() {

        return self::getManyToMany(Model::$USER, Model::$AGREEMENT, Model::$STUDENT, MODEL::$EMPLOYEE)->whereIn(Model::$AGREEMENT . '.' . Model::$AGREEMENT_STATUS, array(AgreementTrait::$STATUS_UNAPPROVED, AgreementTrait::$STATUS_ACTIVE))->distinct();

    }



}
