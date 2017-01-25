<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Validation;
use Session;
use App\StudentDetails;
use App\Student;
use App\Teacher;
use App\TeacherDetails;
use App\ProgramRecord;
use App\Admin;

class UserController extends Controller
{

    /**
     * function login for checking the active session of the Student
     */
    public function login(Request $request)
    {
        if(Auth::guard('student')->check() || Auth::guard('teacher')->check()) {
            return Redirect::to('home')->with(['message' => 'You need to logout first' , 'class' => 'Warning']);
        }
        return view('login');
    }

    /**
     * function register for checking the active session of the Student
     */
    public function register(Request $request)
    {
        if(Auth::guard('student')->check() || Auth::guard('teacher')->check()) {
            return Redirect::to('home')->with(['message' => 'You need to logout first' , 'class' => 'Warning']);
        }

        return view('register');
    }

    /**
     * function home
     */
    public function home(Request $request)
    {
        if (Auth::guard('student')->check()) {
            $programList = ProgramRecord::all();
        } elseif (Auth::guard('admin')->check()) {
            $programList = ProgramRecord::all();
        } elseif (Auth::guard('teacher')->check()) {
            $result = Auth::guard('teacher')->user();
            $programList = ProgramRecord::where('upload_id', $result->id)->orderBy('start', 'asc')->get();
        } else {
            return Redirect::to('login')->with(['message' => 'You need to login first' , 'class' => 'Warning']);
        }
        return view('home')->with('message', ['You are logged in','Success'])->with('programList', $programList);
    }


    /**
     * function logout for deleting of all sessions
     */
    public function logout(Request $request)
    {
        $request->session()->forget('record_id');
        $request->session()->flush();
        Auth::logout();
        return Redirect::to('/');
    }




    public function admin(Request $request)
    {
        if(Auth::guard('admin')->check()) {
            return Redirect::to('/')->with(['message' => 'You need to logout first' , 'class' => 'Warning']);
        }
        return view('admin.login');
    }


    public function adminLogin(Request $request)
    {
        //Validation
        $this->validate(
            $request, [
            'email' => 'required|email|max:255|',
            'password' => 'required|',
            ]
        );

         //Get Input
        $login=Input::all();
        // return $login;
        if(Auth::guard('admin')->attempt(['email' => $login['email'], 'password' => $login['password']])) {
            // return $login;
            return Redirect::to('/home')->with(['message' => 'You are logged in' , 'class' => 'Success']);
        }
        $errors=new MessageBag(['password' => ['Password Invalid']]);
        return Redirect::back()->withErrors($errors)->with(['message' => 'Invalid Credentials' , 'class' => 'Danger']);
    }

}
