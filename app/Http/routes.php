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

Route::get('/reset', 'HomeController@index');

Route::get('/login','SessionController@login');

Route::get('/register','SessionController@register');

Route::post('/student_login','StudentController@login');

Route::get('/home','SessionController@home');

Route::get('/logout','SessionController@logout');

Route::post('/student_register','StudentController@register');

Route::post('/student_details/{id}','StudentController@stu_details');

Route::get('/tlogin','SessionController@tlogin');

Route::get('/tregister','SessionController@tregister');

Route::post('/teacher_login','TeacherController@login');

Route::post('/teacher_register','TeacherController@register');

Route::get('/teacher_details/{id}','TeacherController@tea_details');

Route::get('/std_profile','SessionController@std_profile');
