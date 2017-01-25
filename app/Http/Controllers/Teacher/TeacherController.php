<?php
/**
 * TeacherController Class Doc Comment
 *
 * PHP version 5
 *
 * @category PHP
 * @package  CodePad
 * @author   Ankit Jain <ankitjain28may77@gmail.com>
 * @license  The MIT License (MIT)
 * @link     https://github.com/ncs-jss/Code-Pad
 */
namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\ProgramRecord;
use App\ProgramDetails;
use App\TeacherDetails;
use Session;
use Validator;
use DB;
use Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use Storage;

/**
 * This controller handles the all the functionalities for the Teacher User.
 *
 * @category PHP
 * @package  CodePad
 * @author   Ankit Jain <ankitjain28may77@gmail.com>
 * @license  The MIT License (MIT)
 * @link     https://github.com/ncs-jss/Code-Pad
 */
class TeacherController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Teacher Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the all the functionalities for the Teacher User.
    |
    */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('teacher', ['only' => ['edit','update']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $this->validate(
            $request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:teacher',
            'password' => 'required|min:6|confirmed',
            ]
        );

        //Get Input
        $tregister=Input::all();

        $teacher = new Teacher;
        $teacher->name = $tregister['name'];
        $teacher->email = $tregister['email'];
        $teacher->password =  Hash::make($tregister['password']);
        if($teacher->save()) {
            $result=Teacher::where('email', $tregister['email'])->get();
            foreach ($result as $row) {
                $id=$row->id;
            }

            $teacher_details= new TeacherDetails;
            $teacher_details->teacher_id = $id;
            $teacher_details->save();

            Auth::guard('teacher')->loginUsingId($id);
            return Redirect::to('/home')->with(['message' => 'You are successfully registered' , 'class' => 'Success']);
        }
        return Redirect::back()->withInput()->with(['message' => 'Error in registration, Please Try Again' , 'class' => 'Danger']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = TeacherDetails::where(
            'teacher_id', Auth::guard('teacher')->user()->id
        )->first();
        return view('Teacher.profile')->with('data', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validation
        $this->validate(
            $request,
            [
            'mobile' => '|max:10|min:10',
            'gender' => 'required',
            ]
        );

        //Save in the DB
        $request->flash();

        if (Auth::guard('teacher')->user()['id'] == $id) {

            $teacher_details = Input::all();

            $result = TeacherDetails::where(
                'teacher_id', Auth::guard('teacher')->user()->id
            )->first();
            if ($teacher_details['department']) {
                $result->department = $teacher_details['department'];
            }
            if ($teacher_details['position']) {
                $result->position = $teacher_details['position'];
            }
            if ($teacher_details['mobile']) {
                $result->mobile = $teacher_details['mobile'];
            }
            if ($teacher_details['gender']) {
                $result->gender = $teacher_details['gender'];
            }
            $result->save();

            return Redirect::back()->with(
                [
                'message' => 'Profile is updated!!',
                'class' => 'Success'
                ]
            );
        }

        return Redirect::to('home')->with(
            [
            'message' => 'Invalid Authentication',
            'class' => 'Warning'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * function login for login the teacher
     Create his active session(start and type)
     return to home else return back with errors
     */
    public function login(Request $request)
    {
        //Validation
        $this->validate(
            $request, [
            'email' => 'required|email|max:255|',
            'password' => 'required|',
            ]
        );

         //Get Input
        $tlogin=Input::all();

        if(Auth::guard('teacher')->attempt(['email' => $tlogin['email'], 'password' => $tlogin['password']])) {
            return Redirect::to('/home')->with(['message' => 'You are logged in' , 'class' => 'Success']);
        }
        $errors=new MessageBag(['password' => ['Password Invalid']]);
        return Redirect::back()->withErrors($errors)->with(['message' => 'Invalid Credentials' , 'class' => 'Danger']);
    }

}
