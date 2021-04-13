<?php



use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false, 'verify' => false]);

Route::get('password/email',                    'Auth\ForgotPasswordController@showLinkRequestForm')->name('passwords.email');

Route::post('password/email',                   'Auth\ForgotPasswordController@sendResetLinkEmail');

/*Route::get('password/reset/{token}',            'Auth\ResetPasswordController@showResetForm')->name('passwords.request');*/

Route::post('password/reset',                   'Auth\ResetPasswordController@postReset')->name('passwords.reset');





Route::get('/',                                 'HomeController@landing')->name('landing');

Route::get('/home',                             'HomeController@home')->name('home')->middleware('auth');
