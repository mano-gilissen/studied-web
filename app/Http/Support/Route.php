<?php



namespace App\Http\Support;



class Route {



const LAB_VIEW                                  = 'lab.view';

const FORM_TEST_VIEW                            = 'form_test.view';



const STUDY_LIST                                = 'study.list';

const STUDY_CALENDAR                            = 'study.calendar';

const STUDY_LIST_EXPORT                         = 'study.export';

const STUDY_OVERVIEW_EXPORT                     = 'study.overview.export';

const STUDY_VIEW                                = 'study.view';

const STUDY_EDIT                                = 'study.edit';

const STUDY_DELETE                              = 'study.delete';

const STUDY_PLAN                                = 'study.plan';



const REPORT_CREATE                             = 'report.create';

const REPORT_EDIT                               = 'report.edit';

const REPORT_EXPORT                             = 'report.export';



const AGREEMENT_VIEW                            = 'agreement.view';

const AGREEMENT_CREATE                          = 'agreement.create';

const AGREEMENT_EDIT                            = 'agreement.edit';

const AGREEMENT_FINISH                          = 'agreement.finish';

const AGREEMENT_LIST                            = 'agreement.list';



const STUDENT_CREATE                            = 'student.create';

const STUDENT_LIST                              = 'student.list';

const STUDENT_EDIT                              = 'student.edit';

const CUSTOMER_CREATE                           = 'customer.create';

const CUSTOMER_LIST                             = 'customer.list';

const CUSTOMER_EDIT                             = 'customer.edit';

const EMPLOYEE_CREATE                           = 'employee.create';

const EMPLOYEE_LIST                             = 'employee.list';

const EMPLOYEE_EDIT                             = 'employee.edit';



const PERSON_SELF                               = 'person.self';

const PERSON_VIEW                               = 'person.view';

const PERSON_EDIT                               = 'person.edit';

const PERSON_DELETE                             = 'person.delete';

const PERSON_ACTIVATE                           = 'person.activate';



const USER_ACTIVATE                             = 'user.activate';

const USER_PASSWORD                             = 'user.password';

const USER_EDIT                                 = 'user.edit';



const EVALUATION_VIEW                           = 'evaluation.view';

const EVALUATION_PLAN                           = 'evaluation.plan';

const EVALUATION_EDIT                           = 'evaluation.edit';

const EVALUATION_INTAKE                         = 'evaluation.intake';

const EVALUATION_EVALUATION                     = 'evaluation.evaluation';



const DASHBOARD_VIEW                            = 'dashboard.view';

const ANNOUNCEMENT_CREATE                       = 'announcement.create';



const LOGIN_VIEW                                = 'login.view';

const PASSWORD_FORGOT                           = 'password.forgot';



const LOAD_STUDY_LIST                           = 'load.study.list';

const LOAD_STUDY_COUNTERS                       = 'load.study.counters';

const LOAD_STUDY_FILTER                         = 'load.study.filter';

const LOAD_STUDY_AGREEMENTS                     = 'load.study.agreements';

const LOAD_STUDY_SUBJECTS                       = 'load.study.subjects';



const LOAD_EVALUATION_AGREEMENT                 = 'load.evaluation.agreement';



const LOAD_STUDENT_LIST                         = 'load.student.list';

const LOAD_STUDENT_COUNTERS                     = 'load.student.counters';

const LOAD_STUDENT_FILTER                       = 'load.student.filter';



const LOAD_EMPLOYEE_LIST                        = 'load.employee.list';

const LOAD_EMPLOYEE_COUNTERS                    = 'load.employee.counters';

const LOAD_EMPLOYEE_FILTER                      = 'load.employee.filter';



const LOAD_CUSTOMER_LIST                        = 'load.customer.list';

const LOAD_CUSTOMER_COUNTERS                    = 'load.customer.counters';

const LOAD_CUSTOMER_FILTER                      = 'load.customer.filter';



const LOAD_AGREEMENT_LIST                       = 'load.agreement.list';

const LOAD_AGREEMENT_COUNTERS                   = 'load.agreement.counters';

const LOAD_AGREEMENT_FILTER                     = 'load.agreement.filter';

const LOAD_AGREEMENT_EXTEND                     = 'load.agreement.extend';



const STUDY_PLAN_SUBMIT                         = 'study.plan_submit';

const STUDY_EDIT_SUBMIT                         = 'study.edit_submit';

const REPORT_CREATE_SUBMIT                      = 'report.create_submit';

const REPORT_EDIT_SUBMIT                        = 'report.edit_submit';

const STUDENT_CREATE_SUBMIT                     = 'student.create_submit';

const STUDENT_EDIT_SUBMIT                       = 'student.edit_submit';

const CUSTOMER_CREATE_SUBMIT                    = 'customer.create_submit';

const CUSTOMER_EDIT_SUBMIT                      = 'customer.edit_submit';

const EMPLOYEE_CREATE_SUBMIT                    = 'employee.create_submit';

const EMPLOYEE_EDIT_SUBMIT                      = 'employee.edit_submit';

const AGREEMENT_CREATE_SUBMIT                   = 'agreement.create_submit';

const AGREEMENT_EDIT_SUBMIT                     = 'agreement.edit_submit';

const EVALUATION_PLAN_SUBMIT                    = 'evaluation.plan_submit';

const EVALUATION_EDIT_SUBMIT                    = 'evaluation.edit_submit';

const EVALUATION_PERFORM_SUBMIT                 = 'evaluation.perform_submit';

const ANNOUNCEMENT_CREATE_SUBMIT                = 'announcement.create_submit';

const USER_PASSWORD_SUBMIT                      = 'user.password_submit';

const USER_LANGUAGE_SUBMIT                      = 'user.language_submit';



const ENCRYPT                                   = 'encrypt';

const TEMPLATE                                  = 'template';







const ALL_BOARD                                 = [

    self::LAB_VIEW,
    self::FORM_TEST_VIEW,
    self::ENCRYPT,
    self::TEMPLATE
];



const ALL_MANAGEMENT                            = [

    self::PERSON_EDIT,
    self::PERSON_DELETE,
    self::PERSON_ACTIVATE,
    self::STUDY_LIST_EXPORT,
    self::STUDY_OVERVIEW_EXPORT,
    self::STUDY_DELETE,
    self::REPORT_EXPORT,
    self::AGREEMENT_FINISH,
    self::AGREEMENT_CREATE,
    self::AGREEMENT_EDIT,
    self::STUDENT_CREATE,
    self::STUDENT_EDIT,
    self::CUSTOMER_CREATE,
    self::CUSTOMER_LIST,
    self::CUSTOMER_EDIT,
    self::EMPLOYEE_CREATE,
    self::EMPLOYEE_LIST,
    self::EMPLOYEE_EDIT,
    self::EVALUATION_PLAN,
    self::EVALUATION_EDIT,
    self::EVALUATION_INTAKE,
    self::EVALUATION_EVALUATION,
    self::ANNOUNCEMENT_CREATE,
    self::LOAD_EVALUATION_AGREEMENT,
    self::LOAD_EMPLOYEE_LIST,
    self::LOAD_EMPLOYEE_COUNTERS,
    self::LOAD_EMPLOYEE_FILTER,
    self::LOAD_CUSTOMER_LIST,
    self::LOAD_CUSTOMER_COUNTERS,
    self::LOAD_CUSTOMER_FILTER,
    self::LOAD_AGREEMENT_LIST,
    self::LOAD_AGREEMENT_COUNTERS,
    self::LOAD_AGREEMENT_FILTER,
    self::LOAD_AGREEMENT_EXTEND,
    self::STUDENT_CREATE_SUBMIT,
    self::STUDENT_EDIT_SUBMIT,
    self::CUSTOMER_CREATE_SUBMIT,
    self::CUSTOMER_EDIT_SUBMIT,
    self::EMPLOYEE_CREATE_SUBMIT,
    self::EMPLOYEE_EDIT_SUBMIT,
    self::AGREEMENT_CREATE_SUBMIT,
    self::AGREEMENT_EDIT_SUBMIT,
    self::EVALUATION_PLAN_SUBMIT,
    self::EVALUATION_EDIT_SUBMIT,
    self::EVALUATION_PERFORM_SUBMIT,
    self::ANNOUNCEMENT_CREATE_SUBMIT
];



const ALL_EMPLOYEE                              = [

    self::AGREEMENT_LIST,
    self::REPORT_CREATE,
    self::REPORT_EDIT,
    self::STUDY_EDIT,
    self::STUDY_PLAN,
    self::STUDY_CALENDAR,
    self::STUDENT_LIST,
    self::LOAD_AGREEMENT_LIST,
    self::LOAD_AGREEMENT_COUNTERS,
    self::LOAD_AGREEMENT_FILTER,
    self::LOAD_STUDY_AGREEMENTS,
    self::LOAD_STUDY_SUBJECTS,
    self::LOAD_STUDENT_LIST,
    self::LOAD_STUDENT_COUNTERS,
    self::LOAD_STUDENT_FILTER,
    self::STUDY_PLAN_SUBMIT,
    self::STUDY_EDIT_SUBMIT,
    self::REPORT_CREATE_SUBMIT,
    self::REPORT_EDIT_SUBMIT
];



const ALL_STUDENT                               = [

];



const ALL_CUSTOMER                              = [

    self::STUDENT_LIST,
    self::LOAD_STUDENT_LIST,
    self::LOAD_STUDENT_COUNTERS,
    self::LOAD_STUDENT_FILTER
];



const ALL_AUTH                                  = [

    self::USER_EDIT,
    self::USER_PASSWORD,
    self::STUDY_LIST,
    self::STUDY_VIEW,
    self::AGREEMENT_VIEW,
    self::PERSON_SELF,
    self::PERSON_VIEW,
    self::EVALUATION_VIEW,
    self::LOGIN_VIEW,
    self::PASSWORD_FORGOT,
    self::DASHBOARD_VIEW,
    self::LOAD_STUDY_LIST,
    self::LOAD_STUDY_COUNTERS,
    self::LOAD_STUDY_FILTER,
    self::USER_PASSWORD_SUBMIT,
    self::USER_LANGUAGE_SUBMIT
];





}
