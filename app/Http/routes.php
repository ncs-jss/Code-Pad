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
    return view('welcome');
});

Route::auth();

Route::get('/reset', 'HomeController@index');

Route::get('/login','SessionController@login');

Route::get('/register','SessionController@signup');

Route::post('/student_login','StudentController@login');

Route::get('/home',function() {
	return view('home');
});

Route::get('/logout','StudentController@logout');

Route::post('/student_register','StudentController@register');
