<?php



use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false, 'verify' => false]);





Route::get('/lab',                                  'DebugController@lab')->name('lab.view')->middleware('auth', 'authorize');

Route::get('/form-test',                            'DebugController@form_test')->name('form_test.view')->middleware('auth', 'authorize');





Route::get('/lessen',                               'StudyController@list')->name('study.list')->middleware('auth', 'authorize');

Route::get('/les/{key}',                            'StudyController@view')->name('study.view')->middleware('auth', 'authorize');

Route::get('/les/{key}/bewerken',                   'StudyController@edit')->name('study.edit')->middleware('auth', 'authorize');

Route::get('/les/{key}/rapporteren',                'StudyController@report')->name('study.report')->middleware('auth', 'authorize');

Route::get('/rapport/{key}/bewerken',               'ReportController@edit')->name(\App\Http\Support\Route::REPORT_EDIT)->middleware('auth', 'authorize');

Route::get('/les/{key}/verwijderen',                'StudyController@delete')->name('study.delete')->middleware('auth', 'authorize');

Route::get('/plannen',                              'StudyController@plan')->name('study.plan')->middleware('auth', 'authorize');





Route::get('/vakafspraak/{identifier}',             'AgreementController@view')->name('agreement.view')->middleware('auth', 'authorize');

Route::get('/vakafspraak/{identifier}/afhandelen',  'AgreementController@finish')->name('agreement.finish')->middleware('auth', 'authorize');

Route::get('/vakafspraak/aanmaken/{leerling?}',     'AgreementController@create')->name('agreement.create')->middleware('auth', 'authorize');





Route::get('/leerling/aanmaken',                    'StudentController@create')->name('student.create')->middleware('auth', 'authorize');

Route::get('/leerling/{slug}/bewerken',             'StudentController@edit')->name('student.edit')->middleware('auth', 'authorize');

Route::get('/leerlingen',                           'StudentController@list')->name('student.list')->middleware('auth', 'authorize');

Route::get('/klant/aanmaken',                       'CustomerController@create')->name('customer.create')->middleware('auth', 'authorize');

Route::get('/klant/{slug}/bewerken',                'CustomerController@edit')->name('customer.edit')->middleware('auth', 'authorize');

Route::get('/klanten',                              'CustomerController@list')->name('customer.list')->middleware('auth', 'authorize');

Route::get('/medewerker/aanmaken',                  'EmployeeController@create')->name('employee.create')->middleware('auth', 'authorize');

Route::get('/medewerker/{slug}/bewerken',           'EmployeeController@edit')->name('employee.edit')->middleware('auth', 'authorize');

Route::get('/medewerkers',                          'EmployeeController@list')->name('employee.list')->middleware('auth', 'authorize');





Route::get('/profiel',                              'PersonController@self')->name('person.self')->middleware('auth', 'authorize');

Route::get('/profiel/{slug}',                       'PersonController@view')->name('person.view')->middleware('auth', 'authorize');

Route::get('/profiel/{slug}/bewerken',              'PersonController@edit')->name('person.edit')->middleware('auth', 'authorize');

Route::get('/profiel/{slug}/verwijderen',           'PersonController@delete')->name('person.delete')->middleware('auth', 'authorize');

Route::get('/profiel/{slug}/activeren',             'PersonController@activate')->name('person.activate')->middleware('auth', 'authorize');





Route::get('/activeren/{secret}',                   'UserController@activate')->name('user.activate');

Route::get('/gegevens/wijzigen',                    'UserController@edit')->name('user.edit')->middleware('auth', 'authorize');





Route::get('/gesprek/{key}',                        'EvaluationController@view')->name('evaluation.view')->middleware('auth', 'authorize');

Route::get('/gesprek/aanmaken/{leerling?}',         'EvaluationController@plan')->name('evaluation.plan')->middleware('auth', 'authorize');

Route::get('/kennismaking/{key}',                   'EvaluationController@perform')->name('evaluation.intake')->middleware('auth', 'authorize');

Route::get('/evaluatie/{key}',                      'EvaluationController@perform')->name('evaluation.evaluation')->middleware('auth', 'authorize');





Route::get('/inloggen',                             'Auth\LoginController@view')->name('login.view');

Route::get('/wachtwoordvergeten',                   'Auth\ForgotPasswordController@forgot')->name('password.forgot');





Route::post('/load/study/list',                     'StudyController@list_load')->name('load.study.list')->middleware('auth', 'authorize');

Route::post('/load/study/counters',                 'StudyController@list_counters_load')->name('load.study.counters')->middleware('auth', 'authorize');

Route::post('/load/study/filter',                   'StudyController@list_filter_load')->name('load.study.filter')->middleware('auth', 'authorize');

Route::post('/load/study/agreements',               'UserController@form_study_agreements_load')->name('load.study.agreements')->middleware('auth', 'authorize');

Route::post('/load/study/subjects',                 'StudyController@form_report_subjects_load')->name('load.study.subjects')->middleware('auth', 'authorize');





Route::post('/load/evaluation/agreement',           'EvaluationController@form_perform_agreement_load')->name('load.evaluation.agreement')->middleware('auth', 'authorize');





Route::post('/load/student/list',                   'StudentController@list_load')->name('load.student.list')->middleware('auth', 'authorize');

Route::post('/load/student/counters',               'StudentController@list_counters_load')->name('load.student.counters')->middleware('auth', 'authorize');

Route::post('/load/student/filter',                 'StudentController@list_filter_load')->name('load.student.filter')->middleware('auth', 'authorize');





Route::post('/load/employee/list',                  'EmployeeController@list_load')->name('load.employee.list')->middleware('auth', 'authorize');

Route::post('/load/employee/counters',              'EmployeeController@list_counters_load')->name('load.employee.counters')->middleware('auth', 'authorize');

Route::post('/load/employee/filter',                'EmployeeController@list_filter_load')->name('load.employee.filter')->middleware('auth', 'authorize');





Route::post('/load/customer/list',                  'CustomerController@list_load')->name('load.customer.list')->middleware('auth', 'authorize');

Route::post('/load/customer/counters',              'CustomerController@list_counters_load')->name('load.customer.counters')->middleware('auth', 'authorize');

Route::post('/load/customer/filter',                'CustomerController@list_filter_load')->name('load.customer.filter')->middleware('auth', 'authorize');





Route::post('/submit/study/plan',                   'StudyController@plan_submit')->name('study.plan_submit')->middleware('auth', 'authorize');

Route::post('/submit/study/edit',                   'StudyController@edit_submit')->name('study.edit_submit')->middleware('auth', 'authorize');

Route::post('/submit/study/report',                 'StudyController@report_submit')->name('study.report_submit')->middleware('auth', 'authorize');

Route::post('/submit/report/edit',                  'ReportController@edit_submit')->name(\App\Http\Support\Route::REPORT_EDIT_SUBMIT)->middleware('auth', 'authorize');

Route::post('/submit/student/create',               'StudentController@create_submit')->name('student.create_submit')->middleware('auth', 'authorize');

Route::post('/submit/student/edit',                 'StudentController@edit_submit')->name('student.edit_submit')->middleware('auth', 'authorize');

Route::post('/submit/customer/create',              'CustomerController@create_submit')->name('customer.create_submit')->middleware('auth', 'authorize');

Route::post('/submit/customer/edit',                'CustomerController@edit_submit')->name('customer.edit_submit')->middleware('auth', 'authorize');

Route::post('/submit/employee/create',              'EmployeeController@create_submit')->name('employee.create_submit')->middleware('auth', 'authorize');

Route::post('/submit/employee/edit',                'EmployeeController@edit_submit')->name('employee.edit_submit')->middleware('auth', 'authorize');

Route::post('/submit/agreement/create',             'AgreementController@create_submit')->name('agreement.create_submit')->middleware('auth', 'authorize');

Route::post('/submit/evaluation/plan',              'EvaluationController@plan_submit')->name('evaluation.plan_submit')->middleware('auth', 'authorize');

Route::post('/submit/evaluation/perform',           'EvaluationController@perform_submit')->name('evaluation.perform_submit')->middleware('auth', 'authorize');

Route::post('/submit/activate',                     'UserController@activate_submit')->name('user.activate_submit');

Route::post('/submit/password',                     'UserController@password_submit')->name('user.password_submit')->middleware('auth', 'authorize');

Route::post('/submit/avatar',                       'PersonController@avatar_submit')->name('person.avatar_submit');





Route::get('/encrypt/{value}',                      'LoginController@encrypt')->name('encrypt');

Route::get('/template',                             'DebugController@template')->name('template');

Route::get('/mail_test/{key}',                      'DebugController@mail_test')->name('mail_test');



Route::get('/home',                                 'SiteController@home')->name('home');

Route::get('/actueel',                              'SiteController@actueel')->name('website.actueel');

Route::get('/artikel/{slug}',                       'SiteController@article')->name('website.article');

Route::get('/begeleiding',                          'SiteController@begeleiding')->name('begeleiding');

Route::get('/werk',                                 'SiteController@werk')->name('werk');

Route::get('/werkwijze',                            'SiteController@werkwijze')->name('werkwijze');

Route::get('/zakelijk',                             'SiteController@zakelijk')->name('zakelijk');



Route::get('/', function () {

    return Auth::check() ? redirect('/lessen') : redirect('/home');

});
