<?php



use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false, 'verify' => false]);



Route::get('/',                                 'DebugController@landing')->name('landing');

Route::get('/lab',                              'DebugController@lab')->name('lab.view')->middleware('auth');

Route::get('/formtest',                         'DebugController@form_test')->name('form_test.view')->middleware('auth');



Route::get('/study/{id}',                       'StudyController@view')->name('study.view')->middleware('auth');



Route::get('/inloggen',                         'Auth\LoginController@view')->name('login.view');

Route::get('/wachtwoordvergeten',               'Auth\ForgotPasswordController@forgot')->name('password.forgot');


