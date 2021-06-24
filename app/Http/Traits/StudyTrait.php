<?php



namespace App\Http\Traits;



trait StudyTrait {



    public static

        $STUDY                                          = 'study',

        $STUDY_STATUS                                   = 'status',
        $STUDY_HOST_USER                                = 'host_user',
        $STUDY_HOST_RELATION                            = 'host_relation',
        $STUDY_SUBJECT_DEFINED                          = 'subject_defined',
        $STUDY_SUBJECT_TEXT                             = 'subject_text',
        $STUDY_LOCATION_DEFINED                         = 'location_defined',
        $STUDY_LOCATION_TEXT                            = 'location_text',
        $STUDY_DATE                                     = 'date',
        $STUDY_START                                    = 'start',
        $STUDY_END                                      = 'end',
        $STUDY_TRIAL                                    = 'trial',

        $STATUS_CREATED                                 = 0,
        $STATUS_PLANNED                                 = 1,
        $STATUS_FINISHED                                = 2,
        $STATUS_REPORTED                                = 3,
        $STATUS_CANCELLED                               = 4,
        $STATUS_ABSENT                                  = 5;



}
