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
        return view('teacher.profile')->with('data', $result);
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
     * Create Programs for the Event
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function programDetails(Request $request)
    {
        // Validation
        $this->validate(
            $request,
            [
            'program_name' => 'required|max:255|',
            'program_statement' => 'required|',
            'testcases_input' =>'required',
            'testcases_output' => 'required',
            'time' => 'required',
            'marks' => 'required'
            ]
        );

        // Input
        $pg=Input::all();

        // Save to DB
        $prg = new ProgramDetails;
        $prg->program_name = $pg['program_name'];
        $prg->program_statement = $pg['program_statement'];
        $prg->difficulty = $pg['difficulty'];
        $prg->sample_input = $pg['sample_input'];
        $prg->sample_output = $pg['sample_output'];
        $prg->sample_explanation = $pg['sample_explanation'];
        $prg->time = $pg['time'];
        $prg->marks = $pg['marks'];
        $prg->testcases_input = $pg['testcases_input'];
        $prg->testcases_output = $pg['testcases_output'];
        $prg->record_id = Session::get('record_id');
        if ($prg->save()) {
            if ($pg['decide']=='1') {
                return Redirect::back()->with(
                    [
                    'message' => 'Program is uploaded!!',
                    'class' => 'Success'
                    ]
                );
            }
            $code = ProgramRecord::find(Session::get('record_id'));
            $code = $code->code;
            return Redirect::to('update/' . $code)->with(
                [
                'message' => 'Program is uploaded!!',
                'class' => 'Success'
                ]
            );
        }

        return Redirect::back()->with(
            [
            'message' => 'Program failed to upload',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Show Update Programs Page for the Event
     *
     * @param string $code Contains the Event Unique Code
     * @param int    $id   Contains Id of the associated Event
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProgram($code, $id)
    {
        $result = ProgramDetails::find($id);
        if (Session::get('record_id') == $result['record_id']) {
            return View('program.updateProgram')->with('data', $result);
        }
        return View("errors.503");
    }

    /**
     * Show page after updating the Program
     *
     * @return \Illuminate\Http\Response
     */
    public function programUpdateDone()
    {
        //Get Input
        $result = Input::all();
        //Update data in DB
        $prg = ProgramDetails::find($result['id']);
        $prg->program_name = $result['program_name'];
        $prg->program_statement = $result['program_statement'];
        $prg->difficulty = $result['difficulty'];
        $prg->sample_input = $result['sample_input'];
        $prg->sample_output = $result['sample_output'];
        $prg->sample_explanation = $result['sample_explanation'];
        $prg->time = $result['time'];
        $prg->marks = $result['marks'];
        $prg->testcases_input = $result['testcases_input'];
        $prg->testcases_output = $result['testcases_output'];
        $prg->record_id = Session::get('record_id');
        if ($prg->save()) {
            // return Redirect::to('program')->with('message','Program is updated!');
            // return view('program.update')->with('message','Program is updated!');
            $code = ProgramRecord::find(Session::get('record_id'));
            $code = $code->code;
            return Redirect::to('update/' . $code)->with(
                [
                'message' => 'Program is updated!!',
                'class' => 'Success'
                ]
            );
        } else {
            return Redirect::back()->with(
                [
                'message' => 'Error in updating program, Try Again',
                'class' => 'Danger'
                ]
            );
        }
    }

    /**
     * Shows Event details to the user
     *
     * @return \Illuminate\Http\Response
     */
    public function eventDetails()
    {
        $result = ProgramRecord::find(Session::get('record_id'));
        $start = unserialize($result['starttime']);
        $end = unserialize($result['endtime']);
        $result['startdate'] = $start['startdate'];
        $result['starttime'] = $start['starttime'];
        $result['enddate'] = $end['enddate'];
        $result['endtime'] = $end['endtime'];
        return view('program.eventdetails')->with('data', $result);
    }

    /**
     * Edit the Event Details
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param string  $code    Contains the Event Unique Code
     *
     * @return \Illuminate\Http\Response
     */
    public function eventSave(Request $request, $code)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255|',
            'description' => 'required',
            'starttime' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'endtime' => 'required',
            ]
        );

        $record = Input::all();

        $rec = ProgramRecord::where('code', $code)->first();

        $eventStart = array(
            'startdate' => $record['startdate'],
            'starttime' => $record['starttime']
        );
        $eventEnd = array(
            'enddate' => $record['enddate'],
            'endtime' => $record['endtime']
        );

        $start = $this->dateConversion(
            $record['startdate']
        ) . $this->timeConversion(
            $record['starttime']
        );
        $end = $this->dateConversion(
            $record['enddate']
        ) . $this->timeConversion(
            $record['endtime']
        );
        date_default_timezone_set('Asia/Kolkata');
        $time = $rec->start;
        // return $start-$time;

        if ($end-$start >= 100 && $start - $time >=0) {
            // Save to database
            $rec->name = $record['name'];
            $rec->description = $record['description'];
            $rec->instructions = $record['instructions'];
            $rec->starttime = serialize($eventStart);
            $rec->endtime = serialize($eventEnd);
            $rec->start = $start;
            $rec->end = $end;
            if ($rec->save()) {
                return Redirect::to('update/' . $code)->with(
                    [
                    'message' => 'Record is successfully saved',
                    'class' => 'Success'
                    ]
                );
            }
            return Redirect::back()->with(
                [
                'message' => 'Record is failed',
                'class' => 'Danger'
                ]
            )->withInput();
        } else {
            $errors = new MessageBag(
                [
                'startdate' => ['Event must be start before the end time'],
                'enddate' => ['Event must be end after the start time']
                ]
            );
            return Redirect::back()->withErrors($errors)->withInput()->with(
                [
                'message' => 'Enter correct time,
                    Event must be started after 24 hours from now',
                'class' => 'Warning'
                ]
            );
        }
    }

    /**
     * Delete the Event
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Event ID
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        // $del=ProgramRecord::find($id);
        if ($id == Session::get('record_id')) {
            $del = ProgramRecord::find($id);
            // return $del;
            $del->delete();
            // ProgramRecord::destroy($id);
            // if($)
            return Redirect::to('home')->with(
                [
                'message' => 'Event is successfully deleted',
                'class' => 'Success'
                ]
            );
        }
    }

    /**
     * Check for the Existing Code during the Event Creation
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param string  $code    Contains the Code which needs to be checked
     *
     * @return \Illuminate\Http\Response
     */
    public function checkCode(Request $request, $code)
    {
        // echo $code;
        if (ProgramRecord::where('code', $code)->first()) {
            $errors = new MessageBag(
                [
                'code' => ['Password Invalid']
                ]
            );
            echo $errors;
        } else {
            echo "false";
        }

    }

    /**
     * Add the Program
     *
     * @return \Illuminate\Http\Response
     */
    public function programInput()
    {
        return view('program.input');
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
