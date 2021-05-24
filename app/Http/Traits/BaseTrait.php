<?php



namespace App\Http\Traits;



trait BaseTrait {



    public static

        $BASE_ID                                = 'id',
        $BASE_CREATED_AT                        = 'created_at',
        $BASE_DELETED_AT                        = 'deleted_at',

        $NAMESPACE_MODEL                        = "App\\Models\\";



    #   PLANE { PILOT: X }
    #   PILOT {          }

    #   PLANE->getOneToThis(self::$PILOT, self::$PLANE)

    public function getOneToThis($foreign, $local) {

        return $this->hasOne(self::getModelClass($foreign), $local);

    }



    #   PLANE { PILOT: X }
    #   PILOT {          }

    #   PILOT->getThisToOne(self::$PLANE)

    public function getThisToOne($foreign, $key_local = null) {

        return $this->belongsTo(self::getModelClass($foreign), $key_local ? $key_local : $foreign);

    }



    #   PLANE { PILOT: X }
    #   PLANE { PILOT: X }
    #   PILOT {          }

    #   PILOT->getOneToMany(self::$PLANE, self::$PILOT);

    public function getOneToMany($foreign, $key_foreign, $key_local = null) {

        return $this->hasMany(self::getModelClass($foreign), $key_foreign, $key_local ? $key_local : self::$BASE_ID);

    }



    #   PLANE {          }
    #   PILOT {          }
    #   PLANE_PILOT { PLANE: X; PILOT: X }

    #   PILOT->getManyToMany(self::$PLANE, self::$PLANE_PILOT, self::$PILOT);

    public function getManyToMany($foreign, $pivot, $local) {

        return $this->belongsToMany(self::getModelClass($foreign), $pivot, $local, $foreign);

    }



    public static function getModel($type) {

        return (ucfirst($type));

    }

    public static function getModelClass($type) {

        return self::$NAMESPACE_MODEL . self::getModel($type);

    }



    use AddressTrait, AgreementTrait, AreaTrait, CourseTrait, CustomerTrait, EmployeeTrait, EvaluationTrait, EventTrait,
        InvoiceTrait, LaborTrait, LocationTrait, LogTrait, PersonTrait, RelationTrait, ReportTrait, Report_SubjectTriat,
        RoleTrait, ServiceTrait, StudentTrait, Student_RelationTrait, StudyTrait, Study_ParticipantTrait,
        Study_UserTrait, SubjectTrait, UserTrait;



}
