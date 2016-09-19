<?php

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
use App\program_details;
use App\ProgramRecord;
use App\Student;
use App\Student_Details;
use App\Result;
use Illuminate\Support\MessageBag;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('student');
    }



    /**
    * function std_profile for checking the active session of the Student to make him edit his profile
    */
    public function profile()
    {
        $result=Student_Details::where('student_id',Auth::guard('student')->user()->id)->first();
        return view('student.profile')->with('data',$result);
    }


    /**
     * function stu_details to edit the Student's profile
     */
    public function stu_details(Request $request,$id)
    {

        //Validation
        $this->validate($request,[
            'email' => 'email|max:255',
            'mobile' => '|max:10|min:10',
            'gender' => 'required',
        ]);

        $request->flash();

        //Save in the DB
        if(Auth::guard('student')->user()['id']==$id)
        {
            $student_details=Input::all();

            $result=Student_Details::where('student_id',Auth::guard('student')->user()->id)->first();

            if($student_details['branch'])
                $result->branch=$student_details['branch'];
            if($student_details['year'])
                $result->year=$student_details['year'];
            if($student_details['email'])
                $result->email=$student_details['email'];
            if($student_details['mobile'])
                $result->mobile=$student_details['mobile'];
            if($student_details['gender'])
                $result->gender=$student_details['gender'];
            $result->save();

            return Redirect::back()->with(['message' => 'Profile is updated!!' , 'class' => 'Success']);
        }

        return Redirect::to('home')->with(['message' => 'Invalid User' , 'class' => 'Warning']);
    }

    public function contest($code)
    {

        // Update in a database
        $result=ProgramRecord::where('code',$code)->first();
        if($result)
        {
            Session::put('record_id',$result->id);
            $record = unserialize($result['endtime']);
            $end = $this->dateConversion($record['enddate']).$this->timeConversion($record['endtime']);
            $idd = Auth::guard('student')->user()->id;
            date_default_timezone_set('Asia/Kolkata');
            $time = date("YmdHi",time());
            $check = Result::where([['record_id', $result->id], ['student_id', $idd]])->get();
            // $timer = $result->start-$time;
            $timer = strtotime($result->start)-strtotime($time);
            if($result->start > $time)
            {
                if($check=='[]')
                    return view('program.beforeevent')->with('message', ['message' => 'Register to competete', 'class' => 'Warning', 'success' => 0, 'timer' => $timer]);
                else
                    return view('program.beforeevent')->with('message', ['message' => 'Event is not started yet', 'class' => 'Warning', 'success' => 1, 'timer' => $timer]);
            }
            elseif ($end < $time) {
               return view('program.contest')->with('message', ['message' => 'Event is ended', 'class' => 'Info']);
            }
            else
            {
                if($check=='[]')
                    return view('program.beforeevent')->with('message', ['message' => 'Register to competete', 'class' => 'Warning', 'success' => 0, 'timer' => $timer]);
                return view('program.contest')->with('message', ['message' => 'All the Best!!', 'class' => 'Success']);
            }

        }

        return Redirect::back()->with('message','Incorrect Event');
    }

    public function play(Request $request,$code,$id)
    {
        // return $code;
        $idd = ProgramRecord::where('code',$code)->first();
        date_default_timezone_set('Asia/Kolkata');
        $time = date("YmdHi",time());
        $start = $idd->start;
        $idd = $idd->id;
        $details=Program_Details::where([['id',$id],['record_id',$idd]])->first();
        // return $details;
        if($details && $start < $time)
        {
            $details['code'] = $code;
            return view('program.program')->with('data',$details);
        }
        return Redirect::back()->with('message','Incorrect Event');
    }

    public function eventRegister(Request $request,$code)
    {
        $result=ProgramRecord::where('code',$code)->first();
        $idd = Auth::guard('student')->user()->id;
        $check = Result::where([['record_id', $result->id], ['student_id', $idd]])->get();
        if($result)
        {

            $record = unserialize($result['endtime']);
            $idd = Auth::guard('student')->user()->id;
            date_default_timezone_set('Asia/Kolkata');
            $time = date("YmdHi",time());
            $check = Result::where([['record_id', $result->id], ['student_id', $idd]])->get();
            // $timer = $result->start-$time;
            $record_id = Session::get('record_id');
            $timer = strtotime($result->start)-strtotime($time);

            if($check=='[]')
            {
                $res = new Result;
                $res->student_id = $idd;
                $res->time = 0;
                $res->score = 0;
                $res->attempt = 0;
                $res->record_id = $record_id;
                $res->save();
            }
                // return $time;
            if($result->start <= $time)
            {
                // return $result->start;
                return view('program.contest')->with('message', ['message' => 'All the Best!!', 'class' => 'Success']);
            }
            return view('program.beforeevent')->with('message', ['message' => 'You have successfully registered', 'class' => 'Success', 'success' => 1, 'timer' => $timer]);
        }
        return Redirect::back()->with('message','Incorrect Event');

    }

    public function dateConversion($value)
    {
        $value = explode('/', $value);
        $value = array_reverse($value);
        $value = $value[0]."".$value[2]."".$value[1];
        return $value;
    }
    public function timeConversion($value)
    {
        $time="";
        if(substr($value, -2)=="AM")
        {
            if(substr($value,0,2) == "12")
            {
                $time="00".substr($value,3,2);
            }
            else
            {
                $time=substr($value,0,2).substr($value,3,2);
            }
        }
        else
        {
            if(substr($value,0,2) != "12")
            {
                $time = substr($value,0,2)+12;
                $time=$time.substr($value,3,2);
            }
            else
            {
                $time=substr($value,0,2).substr($value,3,2);
            }
        }
        return $time;
    }


}
