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

Route::get('/', function () {		//Home page
    return view('dashboard');
});

Route::get('/reset', 'HomeController@index');

Route::get('/login','SessionController@login');		// Student login

Route::get('/register','SessionController@register');	// Student register

Route::get('/home','SessionController@home');	// after login/register

Route::get('/logout','SessionController@logout');	// for logout

Route::get('/tlogin','SessionController@tlogin');	// Teacher login

Route::get('/tregister','SessionController@tregister');		// Teacher Register

Route::get('/std_profile','SessionController@std_profile');		// Student profile

Route::get('/tea_profile','SessionController@tea_profile');		// Teacher Profile

Route::get('/program', 'SessionController@program');	// Program record

Route::get('/program_input','SessionController@program_input');		// Program input

Route::get('/error',function(){ 	//Error
	return view('errors.503');
});

Route::get('/check', function() {		// For writing programs
	return view('program.program');
});

Route::get('/update/{id}', 'ProgramController@update_data');    // Update program record

Route::get('/update/{code}/{id}','ProgramController@updateProgram');	// Update the program

Route::get('/check/{id}','ProgramController@checkCode');

Route::get('/write','ProgramController@writeFile');

Route::get('/back',function() {
	return Redirect::to('/');
});

Route::get('/{id}',function() {
	return view('errors.503');
});





// POST routes added

Route::post('/student_login','StudentController@login');	// Check Student login details

Route::post('/student_register','StudentController@register');	// Check and save student registration

Route::post('/student_details/{id}','StudentController@stu_details');	// Save student profile

Route::post('/teacher_login','TeacherController@login');	// Check Teacher login details

Route::post('/teacher_register','TeacherController@register');	// Check and save Teacher registration

Route::post('/teacher_details/{id}','TeacherController@tea_details');	// Save teacher profile

Route::post('/record','ProgramController@record');	// Save program record

Route::post('/program_details','ProgramController@program_details');	// Save program details

Route::post('/check','ProgramController@snippet');	//


Route::post('/programUpdate','ProgramController@ProgramUpdateDone');	// Program update done
