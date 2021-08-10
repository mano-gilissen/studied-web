<?php



use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false, 'verify' => false]);



Route::get('/lab',                              'DebugController@lab')->name('lab.view')->middleware('auth');

Route::get('/form-test',                        'DebugController@form_test')->name('form_test.view')->middleware('auth');



Route::get('/lessen',                           'StudyController@list')->name('study.list')->middleware('auth');

Route::get('/les/{key}',                        'StudyController@view')->name('study.view')->middleware('auth');

Route::get('/les/{key}/rapporteren',            'StudyController@report')->name('study.report')->middleware('auth');

Route::get('/plannen',                          'StudyController@plan')->name('study.plan')->middleware('auth');



Route::get('/leerlingen',                       'StudentController@list')->name('student.list')->middleware('auth');



Route::get('/profiel',                          'PersonController@self')->name('person.self')->middleware('auth');

Route::get('/profiel/{slug}',                   'PersonController@view')->name('person.view')->middleware('auth');



Route::get('/inloggen',                         'Auth\LoginController@view')->name('login.view');

Route::get('/wachtwoordvergeten',               'Auth\ForgotPasswordController@forgot')->name('password.forgot');



Route::post('/load/study/list',                 'StudyController@list_load')->middleware('auth');

Route::post('/load/study/counters',             'StudyController@list_counters_load')->middleware('auth');

Route::post('/load/study/filter',               'StudyController@list_filter_load')->middleware('auth');

Route::post('/load/agreements',                 'UserController@agreements_load')->middleware('auth');



Route::post('/submit/study/plan',               'StudyController@plan_submit')->name('study.plan_submit')->middleware('auth');

Route::post('/submit/study/report',             'StudyController@report_submit')->name('study.report_submit')->middleware('auth');



Route::get('/encrypt/{value}',                  'LoginController@encrypt');



Route::get('/', function () {

    return redirect('/lessen');

});
