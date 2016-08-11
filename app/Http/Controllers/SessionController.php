<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Redirect;

use Session;

class SessionController extends Controller
{

    /**
     * function login for checking the active session of the Student
     */
    public function login(Request $request)
    {
    	if($request->session()->has('start'))
    	{
    		return Redirect::back()->with('message','You need to log out first!');	
    	}

    	return view('student.login');
    }

    /**
     * function register for checking the active session of the Student
     */
    public function register(Request $request)
    {
    	if($request->session()->has('start'))
    	{
    		return Redirect::back()->with('message','You need to log out first!');	
    	}

    	return view('student.register');
    }

    /**
     * function home
     */
    public function home(Request $request)
    {
        if($request->session()->has('start'))
        {
            return view('home');
        }
        return Redirect::to('/login')->with('message','You need to login first');
    }

    /**
     * function tlogin for checking the active session of the teacher
     */
    public function tlogin(Request $request)
    {
        if($request->session()->has('start'))
        {
            return Redirect::back()->with('message','You need to log out first!');  
        }

        return view('teacher.login');
    }

    /**
     * function tregister for checking the active session of the teacher
     */
    public function tregister(Request $request)
    {
        if($request->session()->has('start'))
        {
            return Redirect::back()->with('message','You need to log out first!'); 
        }

        return view('teacher.register');
    }

    /**
     * function logout for deleting of all sessions
     */
    public function logout(Request $request)
    {
        $request->session()->forget('start');
        $request->session()->forget('type');
        $request->session()->forget('record_id');
        $request->session()->flush();
        return Redirect::to('/');
    }

    /**
     * function std_profile for checking the active session of the Student to make him edit his profile
     */
    public function std_profile()
    {
        if(Session::get('type')=='student')
            return view('student.profile');

        return Redirect::to('/home');
    }

    /**
     * function tea_profile for checking the active session of the Teacher to make him edit his profile
     */
    public function tea_profile()
    {
        if(Session::get('type')=='teacher')
            return view('teacher.profile');

        return Redirect::to('/home');
    }

    /**
     * function program for checking the active session of the Teacher to make him create the events
     */
    public function program()
    {
        if(Session::get('type')=='teacher')
        {
            return view('program.record');
        }

        return Redirect::back();
    }

    /**
     * function program_input for checking the active session of the Teacher and record_id to make him input the details of the programs
     */
    public function program_input()
    {
        if(Session::get('type')=='teacher' and Session::get('record_id'))
        {
            return view('program.input');
        }

        return Redirect::back();
    }

}
