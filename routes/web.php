<?php



use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false, 'verify' => false]);



Route::get('/',                                 'TestController@landing')->name('landing');

Route::get('/test',                             'TestController@view')->name('test.view')->middleware('auth');



Route::get('/inloggen',                         'Auth\LoginController@view')->name('login.view');

Route::get('/wachtwoordvergeten',               'Auth\ForgotPasswordController@forgot')->name('password.forgot');

