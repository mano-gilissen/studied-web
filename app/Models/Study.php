<?php



namespace App\Models;

use App\Http\Support\Model;
use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model as ModelClass;
use Illuminate\Database\Eloquent\SoftDeletes;



class Study extends ModelClass {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                          = 'study',
        $dates                                          = ['start', 'end'];



    public function getService() {

        return self::getThisToOne(Model::$SERVICE);

    }



    public function getHost_User() {

        return self::getThisToOne(Model::$USER, Model::$STUDY_HOST_USER);

    }



    public function getHost_Relation() {

        return self::getThisToOne(Model::$RELATION, Model::$STUDY_HOST_RELATION);

    }



    public function getHost() {

        switch ($this->getHost_Type()) {

            case Model::$USER:
                return $this->getHost_User();
            case Model::$RELATION:
                return $this->getHost_Relation();
            default:
                return null;
        }

    }



    public function getHost_Type() {

        return $this->{Model::$STUDY_HOST_USER} ? Model::$USER : ($this->{Model::$STUDY_HOST_RELATION} ? Model::$RELATION : null);

    }



    public function getAgreements() {

        return self::getManyToMany(Model::$AGREEMENT, Model::$STUDY_USER, Model::$STUDY);

    }



    public function getParticipants_User() {

        return self::getManyToMany(Model::$USER, Model::$STUDY_USER, Model::$STUDY);

    }



    public function getParticipants_Participant() {

        return self::getOneToMany(Model::$STUDY_PARTICIPANT, Model::$STUDY);

    }



    public function getAddress() {

        return self::getThisToOne(Model::$ADDRESS);

    }



    public function getReports() {

        return self::getOneToMany(Model::$REPORT, Model::$STUDY);

    }



    public function getReport($user) {

        return Report::where(Model::$STUDY, $this->{Model::$BASE_ID})->where(Model::$USER, $user->{Model::$BASE_ID})->first();

    }



    public function getCourse() {

        return self::getThisToOne(Model::$COURSE);

    }



    private function scopeHasStarted($query) {



    }





}
