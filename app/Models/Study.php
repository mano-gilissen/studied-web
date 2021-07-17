<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use App\Http\Traits\ReportTrait;
use App\Http\Traits\StudyTrait;
use App\Http\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Study extends Model {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                          = 'study';



    public function getService() {

        return self::getThisToOne(self::$SERVICE);

    }



    public function getHost_User() {

        return self::getThisToOne(self::$USER, self::$STUDY_HOST_USER);

    }



    public function getHost_Relation() {

        return self::getThisToOne(self::$RELATION, self::$STUDY_HOST_RELATION);

    }



    public function getHost() {

        switch ($this->getHost_Type()) {

            case self::$USER:
                return $this->getHost_User();
            case self::$RELATION:
                return $this->getHost_Relation();
            default:
                return null;
        }

    }



    public function getHost_Type() {

        return $this->{self::$STUDY_HOST_USER} ? self::$USER : ($this->{self::$STUDY_HOST_RELATION} ? self::$RELATION : null);

    }



    public function getParticipants_User() {

        return self::getManyToMany(self::$USER, self::$STUDY_USER, self::$STUDY);

    }



    public function getParticipants_Participant() {

        return self::getOneToMany(self::$STUDY_PARTICIPANT, self::$STUDY);

    }



    public function getParticipants_Person() {

        $persons                                        = [];

        $users                                          = $this->getParticipants_User();
        $participants                                   = $this->getParticipants_Participant();

        dd($users);

        foreach ($users as $user) {

            array_push($persons, $user->getPerson);

        }

        foreach ($participants as $participant) {

            array_push($persons, $participant->getPerson);

        }

        return $persons;
    }



    public function getSubject_Defined() {

        return self::getThisToOne(self::$SUBJECT, self::$STUDY_SUBJECT_DEFINED);

    }



    public function getLocation_Defined() {

        return self::getThisToOne(self::$LOCATION, self::$STUDY_LOCATION_DEFINED);

    }



    public function getReport($user) {

        return Report::where(self::$STUDY, $this->{self::$BASE_ID})->where(self::$USER, $user->{self::$BASE_ID})->first();

    }



    public function getCourse() {

        return self::getThisToOne(self::$COURSE);

    }



}
