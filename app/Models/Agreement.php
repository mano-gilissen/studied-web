<?php



namespace App\Models;

use App\Http\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Agreement extends Model {



    use BaseTrait;
    use SoftDeletes;



    protected

        $table                                  = 'agreement';



    public function getStudent() {

        return self::getThisToOne(self::$USER, self::$STUDENT);

    }



    public function getEmployee() {

        return self::getThisToOne(self::$USER, self::$STUDENT);

    }



    public function getSubject() {

        return self::getThisToOne(self::$SUBJECT);

    }



    public function hasTrial() {

        return $this->getTrial()->exists();

    }

    public function getTrial() {

        return self::getThisToOne(self::$STUDY, self::$AGREEMENT_TRIAL);

    }



}
