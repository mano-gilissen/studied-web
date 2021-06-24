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



    public function getHost_User() {

        return self::getThisToOne(self::$USER, self::$STUDY_HOST_USER);

    }



    public function getHost_Relation() {

        return self::getThisToOne(self::$RELATION, self::$STUDY_HOST_RELATION);

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
