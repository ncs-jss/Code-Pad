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

//GET routes added

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reset', 'HomeController@index');

Route::get('/login','SessionController@login');

Route::get('/register','SessionController@register');

Route::get('/home','SessionController@home');

Route::get('/logout','SessionController@logout');

Route::get('/tlogin','SessionController@tlogin');

Route::get('/tregister','SessionController@tregister');

Route::get('/std_profile','SessionController@std_profile');

Route::get('/tea_profile','SessionController@tea_profile');

Route::get('/program', 'SessionController@program');

Route::get('/program_input','SessionController@program_input');

Route::get('/error',function(){ 
	return view('errors.503');
});

Route::get('/check', function() {
	return view('program.program');
});



// POST routes added

Route::post('/student_login','StudentController@login');

Route::post('/student_register','StudentController@register');

Route::post('/student_details/{id}','StudentController@stu_details');

Route::post('/teacher_login','TeacherController@login');

Route::post('/teacher_register','TeacherController@register');

Route::post('/teacher_details/{id}','TeacherController@tea_details');

Route::post('/record','ProgramController@record');

Route::post('/program_details','ProgramController@program_details');

Route::post('/check','ProgramController@snippet');

Route::post('/update', 'ProgramController@update_data');
