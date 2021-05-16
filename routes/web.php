<?php



use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false, 'verify' => false]);



Route::get('/',                                 'HomeController@landing')->name('landing');

Route::get('/home',                             'HomeController@view')->name('home.view')->middleware('auth');

Route::get('/inloggen',                         'LoginController@view')->name('login.view');



Route::get('/wachtwoordvergeten',               'Auth\ForgotPasswordController@forgot')->name('password.forgot');

