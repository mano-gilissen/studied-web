<?php



use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false, 'verify' => false]);



Route::get('/',                                 'DebugController@landing')->name('landing');

Route::get('/debug',                            'DebugController@view')->name('debug.view')->middleware('auth');



Route::get('/inloggen',                         'Auth\LoginController@view')->name('login.view');

Route::get('/wachtwoordvergeten',               'Auth\ForgotPasswordController@forgot')->name('password.forgot');

