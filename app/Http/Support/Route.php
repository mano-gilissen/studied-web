<?php



namespace App\Http\Support;



class Route {




const LAB_VIEW                                  = 'lab.view';

const FORM_TEST_VIEW                            = 'form_test.view';



const STUDY_LIST                                = 'study.list';

const STUDY_VIEW                                = 'study.view';

const STUDY_REPORT                              = 'study.report';

const STUDY_EDIT                                = 'study.edit';

const STUDY_DELETE                              = 'study.delete';

const STUDY_PLAN                                = 'study.plan';



const AGREEMENT_VIEW                            = 'agreement.view';

const AGREEMENT_CREATE                          = 'agreement.create';



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



const EVALUATION_VIEW                           = 'evaluation.view';

const EVALUATION_PLAN                           = 'evaluation.plan';

const EVALUATION_INTAKE                         = 'evaluation.intake';

const EVALUATION_EVALUATION                     = 'evaluation.evaluation';



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



const STUDY_PLAN_SUBMIT                         = 'study.plan_submit';

const STUDY_EDIT_SUBMIT                         = 'study.edit_submit';

const STUDY_REPORT_SUBMIT                       = 'study.report_submit';

const STUDENT_CREATE_SUBMIT                     = 'student.create_submit';

const STUDENT_EDIT_SUBMIT                       = 'student.edit_submit';

const CUSTOMER_CREATE_SUBMIT                    = 'customer.create_submit';

const CUSTOMER_EDIT_SUBMIT                      = 'customer.edit_submit';

const EMPLOYEE_CREATE_SUBMIT                    = 'employee.create_submit';

const EMPLOYEE_EDIT_SUBMIT                      = 'employee.edit_submit';

const AGREEMENT_CREATE_SUBMIT                   = 'agreement.create_submit';

const EVALUATION_PLAN_SUBMIT                    = 'evaluation.plan_submit';

const EVALUATION_PERFORM_SUBMIT                 = 'evaluation.perform_submit';



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
    self::STUDY_DELETE,
    self::AGREEMENT_CREATE,
    self::STUDENT_CREATE,
    self::STUDENT_EDIT,
    self::CUSTOMER_CREATE,
    self::CUSTOMER_LIST,
    self::CUSTOMER_EDIT,
    self::EMPLOYEE_CREATE,
    self::EMPLOYEE_LIST,
    self::EMPLOYEE_EDIT,
    self::EVALUATION_PLAN,
    self::EVALUATION_INTAKE,
    self::EVALUATION_EVALUATION,
    self::LOAD_EVALUATION_AGREEMENT,
    self::LOAD_EMPLOYEE_LIST,
    self::LOAD_EMPLOYEE_COUNTERS,
    self::LOAD_EMPLOYEE_FILTER,
    self::LOAD_CUSTOMER_LIST,
    self::LOAD_CUSTOMER_COUNTERS,
    self::LOAD_CUSTOMER_FILTER,
    self::STUDENT_CREATE_SUBMIT,
    self::STUDENT_EDIT_SUBMIT,
    self::CUSTOMER_CREATE_SUBMIT,
    self::CUSTOMER_EDIT_SUBMIT,
    self::EMPLOYEE_CREATE_SUBMIT,
    self::EMPLOYEE_EDIT_SUBMIT,
    self::AGREEMENT_CREATE_SUBMIT,
    self::EVALUATION_PLAN_SUBMIT,
    self::EVALUATION_PERFORM_SUBMIT
];



const ALL_EMPLOYEE                              = [

    self::STUDY_REPORT,
    self::STUDY_EDIT,
    self::STUDY_PLAN,
    self::STUDENT_LIST,
    self::LOAD_STUDY_AGREEMENTS,
    self::LOAD_STUDY_SUBJECTS,
    self::LOAD_STUDENT_LIST,
    self::LOAD_STUDENT_COUNTERS,
    self::LOAD_STUDENT_FILTER,
    self::STUDY_PLAN_SUBMIT,
    self::STUDY_EDIT_SUBMIT,
    self::STUDY_REPORT_SUBMIT
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

    self::STUDY_LIST,
    self::STUDY_VIEW,
    self::AGREEMENT_VIEW,
    self::PERSON_SELF,
    self::PERSON_VIEW,
    self::EVALUATION_VIEW,
    self::LOGIN_VIEW,
    self::PASSWORD_FORGOT,
    self::LOAD_STUDY_LIST,
    self::LOAD_STUDY_COUNTERS,
    self::LOAD_STUDY_FILTER,
];





}
