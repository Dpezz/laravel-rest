<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return 'Welcome Laravel-Rest';
});

Route::group(['middleware' => 'cors', 'prefix' => 'api/v1'], function()
{
    Route::post('authenticate', 'AuthController@auth');
    Route::get('authenticate', 'AuthController@show');
    Route::post('register', 'AuthController@register');
    Route::post('password', 'PasswordController@reset');
});

Route::group(['middleware' => 'cors', 'prefix' => 'api/v1'], function()
{
    Route::resource('users', 'UserController');
    Route::resource('tasks', 'TaskController');
});
