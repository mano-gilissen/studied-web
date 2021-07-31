<?php



namespace App\Http\Support;



class Model {





    public static

        $BASE_ID                                = 'id',
        $BASE_KEY                               = 'key',
        $BASE_CREATED_AT                        = 'created_at',
        $BASE_DELETED_AT                        = 'deleted_at';



    public static

        $USER                                           = 'user',
        $USER_EMAIL                                     = 'email',
        $USER_PASSWORD                                  = 'password',
        $USER_NAME                                      = 'name';



    public static

        $ADDRESS                                    = 'address',

        $ADDRESS_STREET                             = 'street',
        $ADDRESS_NUMBER                             = 'number',
        $ADDRESS_ADDITION                           = 'addition',
        $ADDRESS_ZIPCODE                            = 'zipcode',
        $ADDRESS_CITY                               = 'city',
        $ADDRESS_COUNTRY                            = 'country';



    public static

        $AGREEMENT                                  = 'agreement',

        $AGREEMENT_IDENTIFIER                       = 'identifier',
        $AGREEMENT_START                            = 'start',
        $AGREEMENT_END                              = 'end',
        $AGREEMENT_MIN                              = 'min',
        $AGREEMENT_MAX                              = 'max',
        $AGREEMENT_REMARK                           = 'remark',
        $AGREEMENT_TRIAL                            = 'trial';



    public static

        $AREA                                       = 'area',

        $AREA_NAME                                  = 'name',
        $AREA_CITY                                  = 'city';



    public static

        $COURSE                                 = 'course',

        $COURSE_NAME                            = 'name',
        $COURSE_DESCRIPTION                     = 'description';


    public static

        $CUSTOMER                                       = 'customer',

        $CUSTOMER_REFER                                 = 'refer';



    public static

        $EMPLOYEE                                       = 'employee',

        $EMPLOYEE_EDUCATION_CURRENT                     = 'education_current',
        $EMPLOYEE_EDUCATION_MIDDELBARE                  = 'education_middelbare',
        $EMPLOYEE_SCHOOL_CURRENT                        = 'school_current',
        $EMPLOYEE_SCHOOL_MIDDELBARE                     = 'school_middelbare',
        $EMPLOYEE_PROFILE_CURRENT                       = 'profile_current',
        $EMPLOYEE_PROFILE_MIDDELBARE                    = 'profile_middelbare',

        $EMPLOYEE_MOTIVATION                            = 'motivation',
        $EMPLOYEE_REFER                                 = 'refer',
        $EMPLOYEE_AVAILABILITY                          = 'availability',
        $EMPLOYEE_CV                                    = 'cv',
        $EMPLOYEE_DIPLOMA                               = 'diploma',
        $EMPLOYEE_IDENTIFICATION                        = 'identification',
        $EMPLOYEE_IBAN                                  = 'iban',
        $EMPLOYEE_CONTRACT                              = 'contract',
        $EMPLOYEE_LOONHEFFING                           = 'loonheffing';



    public static

        $EVALUATION                                 = 'evaluation',

        $EVALUATION_HOST                            = 'host',
        $EVALUATION_EMPLOYEE                        = 'employee',
        $EVALUATION_STUDENT                         = 'student',
        $EVALUATION_DATETIME                        = 'datetime',
        $EVALUATION_LOCATION_DEFINED                = 'location_defined',
        $EVALUATION_LOCATION_TEXT                   = 'location_text',
        $EVALUATION_REGARDING                       = 'regarding',
        $EVALUATION_REMARKS                         = 'remarks';



    public static

        $EVENT                                      = 'event',

        $EVENT_LABEL                                = 'label',
        $EVENT_START                                = 'start',
        $EVENT_END                                  = 'end';



    public static

        $INVOICE                                    = 'invoice';



    public static

        $LABOR                                      = 'labor',

        $LABOR_EMPLOYEE_CODE                        = 'employee_code',
        $LABOR_EMPLOYEE_NAME                        = 'employee_name',
        $LABOR_EMPLOYEE_ID                          = 'employee_id',
        $LABOR_TYPE                                 = 'type',
        $LABOR_START                                = 'start',
        $LABOR_END                                  = 'end';



    public static

        $LOCATION                                   = 'location',

        $LOCATION_NAME                              = 'name',
        $LOCATION_LONGITUDE                         = 'longitude',
        $LOCATION_LATITUDE                          = 'latitude',
        $LOCATION_TYPE                              = 'type';



    public static

        $LOG                                            = 'log',

        $LOG_ACTION                                     = 'action',
        $LOG_DATA                                       = 'data';




    public static

        $PERSON                                         = 'person',

        $PERSON_SLUG                                    = 'slug',
        $PERSON_FIRST_NAME                              = 'first_name',
        $PERSON_MIDDLE_NAME                             = 'middle_name',
        $PERSON_LAST_NAME                               = 'last_name',
        $PERSON_PREFIX                                  = 'prefix',
        $PERSON_EMAIL                                   = 'email',
        $PERSON_PHONE                                   = 'phone',
        $PERSON_BIRTH_DATE                              = 'birth_date',
        $PERSON_AVATAR                                  = 'avatar',
        $PERSON_SOCIAL_INSTAGRAM                        = 'social_instagram';



    public static

        $RELATION                                       = 'relation',

        $RELATION_TYPE                                  = 'type',
        $RELATION_DESCRIPTION                           = 'description';



    public static

        $REPORT_SUBJECT                             = 'report_subject',

        $REPORT_SUBJECT_DURATION                    = 'duration';



    public static

        $REPORT                                     = 'report',

        $REPORT_CONTENT_VERSLAG                     = 'content_verslag',
        $REPORT_CONTENT_VOLGENDE_LES                = 'content_volgende_les',
        $REPORT_CONTENT_UITDAGINGEN                 = 'content_uitdagingen',
        $REPORT_CONTENT_VOORTGANG                   = 'content_voortgang',
        $REPORT_TRIAL_SUCCESS                       = 'trial_succes';



    public static

        $ROLE                                           = 'role',

        $ROLE_LABEL                                     = 'label',
        $ROLE_LABEL_PUBLIC                              = 'label_public';



    public static

        $SERVICE                                        = 'service',

        $SERVICE_NAME                                   = 'name',
        $SERVICE_DESCRIPTION                            = 'description',
        $SERVICE_CODE                                   = 'code';



    public static

        $STUDENT_RELATION                       = 'student_relation';





    public static

        $STUDENT                                        = 'student',

        $STUDENT_SCHOOL                                 = 'school',
        $STUDENT_NIVEAU                                 = 'niveau',
        $STUDENT_LEERJAAR                               = 'leerjaar',
        $STUDENT_PROFILE                                = 'profile';



    public static

        $STUDY_PARTICIPANT                          = 'study_participant',

        $STUDY_PARTICIPANT_PAYMENT_REFERENCE        = 'payment_reference',
        $STUDY_PARTICIPANT_PAYMENT_RECEIVED         = 'payment_received';



    public static

        $STUDY_USER                             = 'study_user';


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
        $STUDY_TRIAL                                    = 'trial';



    public static

        $SUBJECT                                    = 'subject',

        $SUBJECT_CODE                               = 'code',
        $SUBJECT_DESCRIPTION_LEVEL                  = 'description_level',
        $SUBJECT_DESCRIPTION_SUBJECT                = 'description_subject',
        $SUBJECT_DESCRIPTION_SHORT                  = 'description_short';






}
