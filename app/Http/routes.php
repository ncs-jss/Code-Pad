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
Route::get('/admin','UserController@admin');


// Teacher controller
Route::group(['namespace' => 'Teacher'], function() {
    Route::get('/update/{id}', [
        'uses' => 'TeacherController@openEvent'
    ]);
    Route::get('/update/{code}/{id}', [
        'uses' => 'TeacherController@updateProgram'
    ]);
    Route::get('/check/{id}', [
        'uses' => 'TeacherController@checkCode'
    ]);
    Route::get('/delete/{id}', [
        'uses' => 'TeacherController@delete'
    ]);
    Route::get('/event-details', [
        'uses' => 'TeacherController@eventdetails'
    ]);
    Route::get('/teacher/profile', [
        'uses' => 'TeacherController@profile'
    ]);
    Route::get('/new', [
        'uses' => 'TeacherController@createEvent'
    ]);
    Route::get('/create', [
        'uses' => 'TeacherController@program_input'
    ]);
    Route::post('/teacher_details/{id}', [
        'uses' => 'TeacherController@tea_details'
    ]);
    Route::post('/record', [
        'uses' => 'TeacherController@record'
    ]);
    Route::post('/program', [
        'uses' => 'TeacherController@programDetails'
    ]);
    Route::post('/programUpdate', [
        'uses' => 'TeacherController@ProgramUpdateDone'
    ]);
    Route::post('{id}/event-details', [
        'uses' => 'TeacherController@eventsave'
    ]);

});

Route::group(['namespace' => 'Admin'], function() {
    Route::get('admin/update/{id}', [
        'uses' => 'AdminController@openEvent'
    ]);
    Route::get('admin/update/{code}/{id}', [
        'uses' => 'AdminController@updateProgram'
    ]);
    Route::get('admin/check/{id}', [
        'uses' => 'AdminController@checkCode'
    ]);
    Route::get('admin/delete/{id}', [
        'uses' => 'AdminController@delete'
    ]);
    Route::get('admin/event-details', [
        'uses' => 'AdminController@eventdetails'
    ]);
    Route::get('admin/new', [
        'uses' => 'AdminController@createEvent'
    ]);
    Route::get('admin/create', [
        'uses' => 'AdminController@program_input'
    ]);
    Route::post('admin/record', [
        'uses' => 'AdminController@record'
    ]);
    Route::post('admin/program', [
        'uses' => 'AdminController@programDetails'
    ]);
    Route::post('admin/programUpdate', [
        'uses' => 'AdminController@ProgramUpdateDone'
    ]);
    Route::post('admin/{id}/event-details', [
        'uses' => 'AdminController@eventsave'
    ]);
    Route::get('admin/contest/{code}/{id}', [
        'uses' => 'AdminController@play'
    ]);
    Route::get('admin/contest/{id}', [
        'uses' => 'AdminController@contest'
    ]);
    Route::get('admin/addAdmin', [
        'uses' => 'AdminController@addAdmin'
    ]);
    Route::get('admin/showAdmin', [
        'uses' => 'AdminController@showAdmin'
    ]);
    Route::post('admin/add', [
        'uses' => 'AdminController@addAdmindata'
    ]);
    Route::get('admin/admin/{id}', [
        'uses' => 'AdminController@editAdmin'
    ]);
    Route::get('admin/edit/{id}', [
        'uses' => 'AdminController@updateAdmin'
    ]);

});

Route::group(['namespace' => 'Student'], function() {
    Route::get('/student/profile', [
        'uses' => 'StudentController@profile'
    ]);
    Route::post('/student_details/{id}', [
        'uses' => 'StudentController@stu_details'
    ]);
    Route::get('/contest/{code}/{id}', [
        'uses' => 'StudentController@play'
    ]);
    Route::get('/contest/{id}', [
        'uses' => 'StudentController@contest'
    ]);
    Route::get('/event/register', [
        'uses' => 'StudentController@eventRegister'
    ]);
});

Route::post('/compile/{code}/{id}','ProgramController@compile');

Route::post('/runcode/{code}/{id}','ProgramController@runstatus');






Route::get('/write','ProgramController@writeFile');
//Error
Route::get('/error',function(){
    return view('errors.503');
});
Route::get('/{id}',function() {
	return view('errors.503');
});





// POST routes added
Route::post('/admin_login','UserController@adminLogin');
Route::post('/student_login','UserController@studentLogin');	// Check Student login details

Route::post('/student_register','UserController@studentRegister');	// Check and save student registration

Route::post('/teacher_login','UserController@teacherLogin');	// Check Teacher login details

Route::post('/teacher_register','UserController@teacherRegister');	// Check and save Teacher registration

Route::post('/check','ProgramController@snippet');



