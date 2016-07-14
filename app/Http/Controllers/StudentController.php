<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Input;

class StudentController extends Controller
{
    function login(Request $request)
    {
    	$student_login=array(
    		'email'=> $request->input('email'), 
    		'password'=> md5($request->input('password')));
    	if($result=DB::select('select * from student where admision_no=? and password=?',[$student_login['email'],$student_login['password']] ))
    	{
    		$request->session()->put('start',1);
    		return redirect('home');
    	}

    	return redirect('login')->with('message','Invalid Credentials!');	

    }

    function register(Request $request)
    {
    	$stuRegister=array('name'=> $request->input('name'), 'email'=>$request->input('email'),
    		'password'=> md5($request->input('password')));
    	if($result=DB::insert('insert into student values(?,?,?,?,?,?)',[null,$stuRegister['name'],$stuRegister['email'],$stuRegister['password'],null,null]))
    	{
    		$request->session()->put('start',1);
    		return redirect('home');
    	}
    	return redirect('register')->with('message','Invalid Credentials!');	
    }

    function logout(Request $request)
    {
    	$request->session()->forget('start');
    	return redirect('/');
    }
}
