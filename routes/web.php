<?php



use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false, 'verify' => false]);



Route::get('/',                                 'HomeController@landing')->name('landing');

Route::get('/home',                             'HomeController@home')->name('home')->middleware('auth');



Route::get('/wachtwoordvergeten',               'Auth/ForgotPasswordController@redirect')->name('forgot.password');

