<?php



use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false, 'verify' => false]);



Route::get('/',                                 'DebugController@landing')->name('landing');

Route::get('/lab',                              'DebugController@lab')->name('lab.view')->middleware('auth');

Route::get('/studytest',                        'DebugController@study_test')->name('study_test.view')->middleware('auth');

Route::get('/formtest',                         'DebugController@form_test')->name('form_test.view')->middleware('auth');



Route::get('/inloggen',                         'Auth\LoginController@view')->name('login.view');

Route::get('/wachtwoordvergeten',               'Auth\ForgotPasswordController@forgot')->name('password.forgot');


