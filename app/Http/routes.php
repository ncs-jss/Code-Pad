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
Route::get('/login','UserController@login');
// User register
Route::get('/register','UserController@register');
// after login/register
Route::get('/home','UserController@home');
// for logout
Route::get('/logout','UserController@logout');
// Student Profile
Route::get('/student/profile','Student\StudentController@profile');
// Teacher Profile
Route::get('/teacher/profile','Teacher\TeacherController@profile');
// Event create
Route::get('/new', 'Teacher\TeacherController@createEvent');
// Program input
Route::get('/create','Teacher\TeacherController@program_input');
//Error
Route::get('/error',function(){
	return view('errors.503');
});
// For writing programs
Route::get('/check', function() {
	return view('program.program');
});
// Update program record
Route::get('/update/{id}', 'Teacher\TeacherController@openEvent');

Route::get('/contest/{id}', 'ProgramController@contest');

Route::get('/update/{code}/{id}','Teacher\TeacherController@updateProgram');	// Update the program

Route::get('/check/{id}','Teacher\TeacherController@checkCode');

Route::get('/delete/{id}','Teacher\TeacherController@delete');

Route::get('/write','ProgramController@writeFile');

Route::get('/{id}',function() {
	return view('errors.503');
});





// POST routes added

Route::post('/student_login','UserController@studentLogin');	// Check Student login details

Route::post('/student_register','UserController@studentRegister');	// Check and save student registration

Route::post('/student_details/{id}','Student\StudentController@stu_details');	// Save student profile

Route::post('/teacher_login','UserController@teacherLogin');	// Check Teacher login details

Route::post('/teacher_register','UserController@teacherRegister');	// Check and save Teacher registration

Route::post('/teacher_details/{id}','Teacher\TeacherController@tea_details');	// Save teacher profile

Route::post('/record','Teacher\TeacherController@record');	// Save program record

Route::post('/program','Teacher\TeacherController@programDetails');	// Save program details

Route::post('/check','ProgramController@snippet');	//


Route::post('/programUpdate','Teacher\TeacherController@ProgramUpdateDone');	// Program update done
