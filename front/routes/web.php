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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/blog/{id}', 'HomeController@blog');

Route::get('/logout', function() {
    Auth::logout();
});

Route::post('/registers', 'Auth\RegisterController@register')->name('registers');
Route::post('/logins', 'Auth\LoginController@login')->name('logins');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::post('/resetpassword', 'Auth\ResetPasswordController@reset')->name('reset');

Route::prefix('student')->middleware('auth')->group(function () {
    Route::get('/', 'HomeController@dashboard');
    Route::resource('/setting', 'SettingUserController');
    Route::resource('/curiculum', 'CuriculumController');
    Route::resource('/feedback', 'FeedbackController');
    Route::resource('/modul', 'ModulController');
    Route::resource('/project', 'ProjectController');
    Route::get('/add', 'ProjectController@add');
    Route::get('/event', 'HomeController@event');
    Route::get('/event/{id}', 'HomeController@eventDetail');
});
