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
        $this->middleware('teacher');
    }


    /**
     * Show Profile Page of Teacher
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $result=TeacherDetails::where(
            'teacher_id', Auth::guard('teacher')->user()->id
        )->first();
        return view('Teacher.profile')->with('data', $result);
    }

    /**
     * Update Teacher Details and Render Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains Id of the associated Event
     *
     * @return \Illuminate\Http\Response
     */
    public function teacherDetails(Request $request, $id)
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
     * Date Conversion
     *
     * @param string $value Contains the Date
     *
     * @return string
     */
    public function dateConversion($value)
    {
        $value = explode('/', $value);
        $value = array_reverse($value);
        $value = $value[0] . "" . $value[2] . "" . $value[1];
        return $value;
    }

    /**
     * Converts Time
     *
     * @param string $value Contains the time
     *
     * @return string
     */
    public function timeConversion($value)
    {
        $time = "";
        if (substr($value, -2) == "AM") {
            if (substr($value, 0, 2) == "12") {
                $time="00" . substr($value, 3, 2);
            } else {
                $time=substr($value, 0, 2) . substr($value, 3, 2);
            }
        } else {
            if (substr($value, 0, 2) != "12") {
                $time = substr($value, 0, 2) + 12;
                $time = $time . substr($value, 3, 2);
            } else {
                $time = substr($value, 0, 2) . substr($value, 3, 2);
            }
        }
        return $time;
    }

}
