<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Study extends Model {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'study';



    public function getService() {

        return self::getThisToOne(self::$SERVICE);

    }



    public function getHost_User() {

        return self::getThisToOne(self::$USER, self::$STUDY_HOST_USER);

    }



    public function getHost_Relation() {

        return self::getThisToOne(self::$RELATION, self::$STUDY_HOST_RELATION);

    }



    public function getHost_Type() {

        return $this->{self::$USER} ? self::$USER : $this->{self::$RELATION} ? self::$RELATION : null;

    }



    public function getHost_Person() {

        switch($this->getHost_Type()) {

            case self::$USER:
                return $this->getHost_User()->getPerson();
            case self::$RELATION:
                return $this->getHost_Relation()->getPerson();
            default:
                return null;
        }
    }



    public function getSubject_Defined() {

        return self::getThisToOne(self::$SUBJECT, self::$STUDY_SUBJECT_DEFINED);

    }



    public function getLocation_Defined() {

        return self::getThisToOne(self::$LOCATION, self::$STUDY_LOCATION_DEFINED);

    }



    public function getCourse() {

        return self::getThisToOne(self::$COURSE);

    }



}
