<?php



use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false, 'verify' => false]);



Route::get('/',                                 'DebugController@landing')->name('landing');

Route::get('/lab',                              'DebugController@lab')->name('lab.view')->middleware('auth');

Route::get('/form-test',                        'DebugController@form_test')->name('form_test.view')->middleware('auth');



Route::get('/lessen',                           'StudyController@list')->name('study.list')->middleware('auth');

Route::get('/les/{key}',                        'StudyController@view')->name('study.view')->middleware('auth');



Route::get('/profiel/{slug}',                   'PersonController@profile')->name('person.profile')->middleware('auth');



Route::get('/inloggen',                         'Auth\LoginController@view')->name('login.view');

Route::get('/wachtwoordvergeten',               'Auth\ForgotPasswordController@forgot')->name('password.forgot');




Route::post('/load/study-list',                 'StudyController@list_load')->middleware('auth');
