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

//Home page
Route::get('/', function () {
    return view('dashboard');
});

Route::get('/reset', 'HomeController@index');
// User login
Route::get('/login','SessionController@login');
// User register
Route::get('/register','SessionController@register');
// after login/register
Route::get('/home','SessionController@home');
// for logout
Route::get('/logout','SessionController@logout');
// Student Profile
Route::get('/std_profile','SessionController@std_profile')->middleware('student');
// Teacher Profile
Route::get('/tea_profile','SessionController@tea_profile')->middleware('teacher');
// Program record
Route::get('/program', 'SessionController@program')->middleware('teacher');
// Program input
Route::get('/program_input','SessionController@program_input')->middleware(['teacher','program']);
//Error
Route::get('/error',function(){
	return view('errors.503');
});
// For writing programs
Route::get('/check', function() {
	return view('program.program');
});
// Update program record
Route::get('/update/{id}', 'ProgramController@update_data')->middleware('teacher');

Route::get('/contest/{id}', 'ProgramController@contest');

Route::get('/update/{code}/{id}','ProgramController@updateProgram')->middleware('teacher');	// Update the program

Route::get('/check/{id}','ProgramController@checkCode');

Route::get('/delete/{id}','ProgramController@delete')->middleware('teacher');

Route::get('/write','ProgramController@writeFile');

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
