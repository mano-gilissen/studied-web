<?php



use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false, 'verify' => false]);



Route::get('/lab',                              'DebugController@lab')->name('lab.view')->middleware('auth');

Route::get('/form-test',                        'DebugController@form_test')->name('form_test.view')->middleware('auth');



Route::get('/lessen',                           'StudyController@list')->name('study.list')->middleware('auth');

Route::get('/les/{key}',                        'StudyController@view')->name('study.view')->middleware('auth');

Route::get('/plannen',                          'StudyController@plan')->name('study.plan')->middleware('auth');



Route::get('/profiel',                          'PersonController@self')->name('person.self')->middleware('auth');

Route::get('/profiel/{slug}',                   'PersonController@view')->name('person.view')->middleware('auth');



Route::get('/inloggen',                         'Auth\LoginController@view')->name('login.view');

Route::get('/wachtwoordvergeten',               'Auth\ForgotPasswordController@forgot')->name('password.forgot');



Route::get('/load/list/study',                  'StudyController@list_load')->middleware('auth');
//Route::post('/load/list/study',                 'StudyController@list_load')->middleware('auth');



Route::post('/submit/study/plan',               'StudyController@plan_submit')->name('study.plan_submit')->middleware('auth');



Route::get('/', function () {

    return redirect('/lessen');

});
