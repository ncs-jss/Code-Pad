<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Redirect;

use Session;

class SessionController extends Controller
{
    function login(Request $request)
    {
    	if($request->session()->has('start'))
    	{
    		return Redirect::back()->with('message','You need to log out first!');	
    	}

    	return view('student.login');
    }

    function register(Request $request)
    {
    	if($request->session()->has('start'))
    	{
    		return Redirect::back()->with('message','You need to log out first!');	
    	}

    	return view('student.register');
    }

    function home(Request $request)
    {
        if($request->session()->has('start'))
        {
            return view('home');
        }
        return Redirect::to('/login')->with('message','You need to login first');
    }

    function tlogin(Request $request)
    {
        if($request->session()->has('start'))
        {
            return Redirect::back()->with('message','You need to log out first!');  
        }

        return view('teacher.login');
    }

    function tregister(Request $request)
    {
        if($request->session()->has('start'))
        {
            return Redirect::back()->with('message','You need to log out first!'); 
        }

        return view('teacher.register');
    }

    function logout(Request $request)
    {
        $request->session()->forget('start');
        $request->session()->forget('type');
        return Redirect::to('/');
    }

    function std_profile()
    {
        if(Session::get('type')=='student')
            return view('student.profile');

        return Redirect::to('/home');
    }

    function tea_profile()
    {
        if(Session::get('type')=='teacher')
            return view('teacher.profile');

        return Redirect::to('/home');
    }

    function program()
    {
        if(Session::get('type')=='teacher')
        {
            return view('program.record');
        }

        return Redirect::back();
    }

}
