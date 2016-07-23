<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Redirect;

use Session;

class SessionController extends Controller
{
    public function login(Request $request)
    {
    	if($request->session()->has('start'))
    	{
    		return Redirect::back()->with('message','You need to log out first!');	
    	}

    	return view('student.login');
    }

    public function register(Request $request)
    {
    	if($request->session()->has('start'))
    	{
    		return Redirect::back()->with('message','You need to log out first!');	
    	}

    	return view('student.register');
    }

    public function home(Request $request)
    {
        if($request->session()->has('start'))
        {
            return view('home');
        }
        return Redirect::to('/login')->with('message','You need to login first');
    }

    public function tlogin(Request $request)
    {
        if($request->session()->has('start'))
        {
            return Redirect::back()->with('message','You need to log out first!');  
        }

        return view('teacher.login');
    }

    public function tregister(Request $request)
    {
        if($request->session()->has('start'))
        {
            return Redirect::back()->with('message','You need to log out first!'); 
        }

        return view('teacher.register');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('start');
        $request->session()->forget('type');
        $request->session()->forget('record_id');
        return Redirect::to('/');
    }

    public function std_profile()
    {
        if(Session::get('type')=='student')
            return view('student.profile');

        return Redirect::to('/home');
    }

    public function tea_profile()
    {
        if(Session::get('type')=='teacher')
            return view('teacher.profile');

        return Redirect::to('/home');
    }

    public function program()
    {
        if(Session::get('type')=='teacher')
        {
            return view('program.record');
        }

        return Redirect::back();
    }

    public function program_input()
    {
        if(Session::get('type')=='teacher' and Session::get('record_id'))
        {
            return view('program.input');
        }

        return Redirect::back();
    }

}
