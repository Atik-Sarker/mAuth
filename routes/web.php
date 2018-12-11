<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//==================Users Routes...
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/auth/activate', 'Auth\ActivationController@activate')->name('Auth.activation');
Route::get('/user/change/password', 'HomeController@showChangePassForm')->name('user.password.request');;
Route::post('/user/change/password', 'HomeController@UserChangePassword')->name('change.password.request');;
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');;
//==================Admin Routes...
Route::prefix('admin')->group(function (){
    // Authentication Routes...
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    // Password Reset Routes...
    Route::get('password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'Admin\ResetPasswordController@reset');
    Route::get('password/changes', 'AdminController@showChangepassForm')->name('admin.password.changes');
    Route::post('password/update', 'AdminController@AdminChangePassword')->name('admin.password.changes.submit');

});

