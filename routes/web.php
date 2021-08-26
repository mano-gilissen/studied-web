<?php



use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false, 'verify' => false]);



Route::get('/lab',                              'DebugController@lab')->name('lab.view')->middleware('auth');

Route::get('/form-test',                        'DebugController@form_test')->name('form_test.view')->middleware('auth');



Route::get('/lessen',                           'StudyController@list')->name('study.list')->middleware('auth');

Route::get('/les/{key}',                        'StudyController@view')->name('study.view')->middleware('auth');

Route::get('/les/{key}/rapporteren',            'StudyController@report')->name('study.report')->middleware('auth');

Route::get('/plannen',                          'StudyController@plan')->name('study.plan')->middleware('auth');



Route::get('/leerling/aanmaken',                'StudentController@create')->name('student.create')->middleware('auth');

Route::get('/leerlingen',                       'StudentController@list')->name('student.list')->middleware('auth');



Route::get('/klant/aanmaken',                   'CustomerController@create')->name('customer.create')->middleware('auth');

Route::get('/klanten',                          'CustomerController@list')->name('customer.list')->middleware('auth');



Route::get('/medewerkers',                      'EmployeeController@list')->name('employee.list')->middleware('auth');



Route::get('/profiel',                          'PersonController@self')->name('person.self')->middleware('auth');

Route::get('/profiel/{slug}',                   'PersonController@view')->name('person.view')->middleware('auth');



Route::get('/gesprek/{key}',                    'EvaluationController@view')->name('evaluation.view')->middleware('auth');

Route::get('/gesprek/aanmaken',                 'EvaluationController@plan')->name('evaluation.plan')->middleware('auth');



Route::get('/inloggen',                         'Auth\LoginController@view')->name('login.view');

Route::get('/wachtwoordvergeten',               'Auth\ForgotPasswordController@forgot')->name('password.forgot');




Route::post('/load/study/list',                 'StudyController@list_load')->middleware('auth');

Route::post('/load/study/counters',             'StudyController@list_counters_load')->middleware('auth');

Route::post('/load/study/filter',               'StudyController@list_filter_load')->middleware('auth');

Route::post('/load/study/agreements',           'UserController@form_study_agreements_load')->middleware('auth');

Route::post('/load/study/subjects',             'StudyController@form_report_subjects_load')->middleware('auth');



Route::post('/load/student/list',               'StudentController@list_load')->middleware('auth');

Route::post('/load/student/counters',           'StudentController@list_counters_load')->middleware('auth');

Route::post('/load/student/filter',             'StudentController@list_filter_load')->middleware('auth');



Route::post('/load/employee/list',              'EmployeeController@list_load')->middleware('auth');

Route::post('/load/employee/counters',          'EmployeeController@list_counters_load')->middleware('auth');

Route::post('/load/employee/filter',            'EmployeeController@list_filter_load')->middleware('auth');



Route::post('/load/customer/list',              'CustomerController@list_load')->middleware('auth');

Route::post('/load/customer/counters',          'CustomerController@list_counters_load')->middleware('auth');

Route::post('/load/customer/filter',            'CustomerController@list_filter_load')->middleware('auth');



Route::post('/submit/study/plan',               'StudyController@plan_submit')->name('study.plan_submit')->middleware('auth');

Route::post('/submit/study/report',             'StudyController@report_submit')->name('study.report_submit')->middleware('auth');

Route::post('/submit/student/create',           'StudentController@create_submit')->name('student.create_submit')->middleware('auth');

Route::post('/submit/customer/create',          'CustomerController@create_submit')->name('customer.create_submit')->middleware('auth');



Route::get('/encrypt/{value}',                  'LoginController@encrypt');

Route::get('/template',                         'DebugController@template');



Route::get('/', function () {

    return redirect('/lessen');

});
