<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Redirect;

class SessionController extends Controller
{
    function login(Request $request)
    {
    	if($request->session()->has('start'))
    	{
    		return Redirect::to('home')->with('message','You need to log out first!');	
    	}

    	return view('auth.login');
    }

    function signup(Request $request)
    {
    	if($request->session()->has('start'))
    	{
    		return Redirect::to('/home')->with('message','You need to log out first!');	
    	}

    	return view('auth.register');
    }
}
