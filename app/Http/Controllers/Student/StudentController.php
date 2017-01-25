<?php
/**
 * StudentController Class Doc Comment
 *
 * PHP version 5
 *
 * @category PHP
 * @package  CodePad
 * @author   Ankit Jain <ankitjain28may77@gmail.com>
 * @license  The MIT License (MIT)
 * @link     https://github.com/ncs-jss/Code-Pad
 */
namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Session;
use Auth;
use Redirect;
use App\ProgramDetails;
use App\ProgramRecord;
use App\Student;
use App\StudentDetails;
use App\Result;
use Illuminate\Support\MessageBag;

/**
 * This controller handles the all the functionalities for the Student User.
 *
 * @category PHP
 * @package  CodePad
 * @author   Ankit Jain <ankitjain28may77@gmail.com>
 * @license  The MIT License (MIT)
 * @link     https://github.com/ncs-jss/Code-Pad
 */
class StudentController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Student Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the all the functionalities for the Student User.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('student');
    }


    /**
     * Show Profile Page of Student
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $result = StudentDetails::where(
            'student_id', Auth::guard('student')->user()->id
        )->first();
        return view('Student.profile')->with('data', $result);
    }


    /**
     * Update Student Details and Render Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains Id of the associated Event
     *
     * @return \Illuminate\Http\Response
     */
    public function studentDetails(Request $request, $id)
    {

        //Validation
        $this->validate(
            $request,
            [
            'email' => 'email|max:255',
            'mobile' => '|max:10|min:10',
            'gender' => 'required',
            ]
        );

        $request->flash();

        //Save in the DB
        if (Auth::guard('student')->user()['id'] == $id) {
            $student_details = Input::all();

            $result = StudentDetails::where(
                'student_id', Auth::guard('student')->user()->id
            )->first();

            if ($student_details['branch']) {
                $result->branch = $student_details['branch'];
            }
            if ($student_details['year']) {
                $result->year=$student_details['year'];
            }
            if ($student_details['email']) {
                $result->email = $student_details['email'];
            }
            if ($student_details['mobile']) {
                $result->mobile = $student_details['mobile'];
            }
            if ($student_details['gender']) {
                $result->gender = $student_details['gender'];
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
            'message' => 'Invalid User',
            'class' => 'Warning'
            ]
        );
    }

    /**
     * Contest Page Renders Before and after the Starting of Event
     *
     * @param string $code Contains Code of the associated Event
     *
     * @return \Illuminate\Http\Response
     */
    public function contest($code)
    {

        // Update in a database
        $result = ProgramRecord::where('code', $code)->first();
        if ($result) {

            Session::put('record_id', $result->id);
            $record = unserialize($result['endtime']);
            $end = $this->dateConversion(
                $record['enddate']
            ) . $this->timeConversion(
                $record['endtime']
            );
            $idd = Auth::guard('student')->user()->id;
            date_default_timezone_set('Asia/Kolkata');
            $time = date("YmdHi", time());
            $check = Result::where(
                [
                [
                'record_id', $result->id
                ],
                [
                'student_id', $idd
                ]
                ]
            )->get();

            // $timer = $result->start-$time;
            $timer = strtotime($result->start) - strtotime($time);
            if ($result->start > $time) {
                if ($check == '[]') {
                    return view('Event.BeforeEvent')->with(
                        'message',
                        [
                        'message' => 'Register to competete',
                        'class' => 'Warning',
                        'success' => 0,
                        'timer' => $timer
                        ]
                    );
                } else {
                    return view('Event.BeforeEvent')->with(
                        'message',
                        [
                        'message' => 'Event is not started yet',
                        'class' => 'Warning',
                        'success' => 1,
                        'timer' => $timer
                        ]
                    );
                }
            } elseif ($end < $time) {
                return view('Event.Contest')->with(
                    'message',
                    [
                    'message' => 'Event is ended',
                    'class' => 'Info'
                    ]
                );
            } else {
                if ($check == '[]') {
                    return view('Event.BeforeEvent')->with(
                        'message',
                        [
                        'message' => 'Register to competete',
                        'class' => 'Warning',
                        'success' => 0,
                        'timer' => $timer
                        ]
                    );
                }
                return view('Event.Contest')->with(
                    'message',
                    [
                    'message' => 'All the Best!!',
                    'class' => 'Success'
                    ]
                );
            }
        }
        return Redirect::back()->with('message', 'Incorrect Event');
    }



    /**
     * Show Event Register Page if Event is not Started
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param string  $code    Contains Code of the associated Event
     *
     * @return \Illuminate\Http\Response
     */
    public function eventRegister(Request $request, $code)
    {
        $result = ProgramRecord::where('code', $code)->first();
        $idd = Auth::guard('student')->user()->id;
        $check = Result::where(
            [
            [
            'record_id', $result->id
            ],
            [
            'student_id', $idd
            ]
            ]
        )->get();

        if ($result) {

            $record = unserialize($result['endtime']);
            $idd = Auth::guard('student')->user()->id;
            date_default_timezone_set('Asia/Kolkata');
            $time = date("YmdHi", time());
            $check = Result::where(
                [
                [
                'record_id', $result->id
                ],
                [
                'student_id', $idd
                ]
                ]
            )->get();

            // $timer = $result->start-$time;
            $record_id = Session::get('record_id');
            $timer = strtotime($result->start) - strtotime($time);

            if ($check == '[]') {
                $res = new Result;
                $res->student_id = $idd;
                $res->time = 0;
                $res->score = 0;
                $prg = [];
                $number = ProgramDetails::where('record_id', $result->id)->get();
                foreach ($number as $key) {
                    $prg['program-id' . $key->id] = 0;
                    $prg['marks-' . $key->id] = 0;
                    $prg['done-' . $key->id] = 0;
                }
                $res->attempt = serialize($prg);
                $res->record_id = $record_id;
                $res->save();
            }
                // return $time;
            if ($result->start <= $time) {
                return view('Event.Contest')->with(
                    'message',
                    [
                    'message' => 'All the Best!!',
                    'class' => 'Success'
                    ]
                );
            }
            return view('Event.BeforeEvent')->with(
                'message',
                [
                'message' => 'You have successfully registered',
                'class' => 'Success',
                'success' => 1,
                'timer' => $timer
                ]
            );
        }
        return Redirect::back()->with('message', 'Incorrect Event');

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
                $time = "00" . substr($value, 3, 2);
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
