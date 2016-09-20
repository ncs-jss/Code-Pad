<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\ProgramRecord;
use App\Program_Details;
use App\Teacher_Details;
use Session;
use Validator;
use DB;
use Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use Storage;

class TeacherController extends Controller
{
    /**
     * Contructor for middleware
     */
    public function __construct()
    {
        $this->middleware('teacher');
    }


    /**
     * function tea_profile for checking the active session of the Teacher to make him edit his profile
     */
    public function profile()
    {
        $result=Teacher_Details::where('teacher_id',Auth::guard('teacher')->user()->id)->first();
        return view('teacher.profile')->with('data',$result);
    }

    /**
     * function tea_details to edit the teacher's profile
     */
    public function tea_details(Request $request,$id)
    {

        //Validation
        $this->validate($request,[
            'mobile' => '|max:10|min:10',
            'gender' => 'required',
        ]);

        //Save in the DB
        $request->flash();

        if(Auth::guard('teacher')->user()['id']==$id)
        {

            $teacher_details=Input::all();

            $result=Teacher_Details::where('teacher_id',Auth::guard('teacher')->user()->id)->first();
            if($teacher_details['department'])
                $result->department=$teacher_details['department'];
            if($teacher_details['position'])
                $result->position=$teacher_details['position'];
            if($teacher_details['mobile'])
                $result->mobile=$teacher_details['mobile'];
            if($teacher_details['gender'])
                $result->gender=$teacher_details['gender'];
            $result->save();

            return Redirect::back()->with(['message' => 'Profile is updated!!' , 'class' => 'Success']);
        }

        return Redirect::to('home')->with(['message' => 'Invalid Authentication' , 'class' => 'Warning']);
    }


    /**
     * function program for checking the active session of the Teacher to make him create the events
     */
    public function createEvent()
    {
        // Session::flash('message','Create an Event');
        return view('program.record');
    }


    /**
     * function record for creating new event and saving it in database
     * Create a session for event(record_id)
     * return to program_input if successfully saved else return back
     */
    public function record(Request $request)
    {
        // Validation
        $this->validate($request,[
            'name' => 'required|max:255|',
            'code' => 'required|max:20|unique:compiler_record',
            'description' => 'required',
            'starttime' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'endtime' => 'required',
            'uploaded_by'=>'required',
            'upload_id' => 'required',
        ]);


        $record = Input::all();
        // return $record;
        $eventStart = array('startdate' => $record['startdate'] , 'starttime' => $record['starttime'] );
        $eventEnd = array('enddate' => $record['enddate'] , 'endtime' => $record['endtime'] );
        // return substr($record['starttime'],-2);
        $start = $this->dateConversion($record['startdate']).$this->timeConversion($record['starttime']);
        $end = $this->dateConversion($record['enddate']).$this->timeConversion($record['endtime']);
        date_default_timezone_set('Asia/Kolkata');
        $time = date("YmdHi",time());
        // return $start-$time;
        if($end-$start >= 100 && $start-$time >=10000 )
        {
            if($record['uploaded_by']==Auth::guard('teacher')->user()->name)
            {
                // Save to database
                $rec = new ProgramRecord;
                $rec->name=$record['name'];
                $rec->code=$record['code'];
                $rec->description=$record['description'];
                $rec->starttime=serialize($eventStart);
                $rec->endtime=serialize($eventEnd);
                $rec->start=$start;
                $rec->uploaded_by=$record['uploaded_by'];
                $rec->upload_id=$record['upload_id'];
                if($rec->save())
                {
                    $result=ProgramRecord::where('code',$record['code'])->first();

                    // Session create
                    Session::put('record_id',$result->id);

                    // Create a new file for that particular event with its unique code
                    Storage::put('record/'.$record['code'].'.txt','');
                    return Redirect::to('create')->with(['message' => 'Record is successfully saved' , 'class' => 'Success']);
                }
                return Redirect::back()->with(['message' => 'Record is failed' , 'class' => 'Danger'])->withInput();
            }
            $errors=new MessageBag(['uploaded_by' => ['This field must be your name']]);
            return Redirect::back()->withErrors($errors)->withInput()->with(['message' => 'Event must be created by you' , 'class' => 'Warning']);
        }
        else
        {
            $errors=new MessageBag(['startdate' => ['Event must be start before the end time'], 'enddate' => ['Event must be end after the start time']]);
            return Redirect::back()->withErrors($errors)->withInput()->with(['message' => 'Enter correct time, Event must be started after 24 hours from now' , 'class' => 'Warning']);
        }
    }

    /**
     * function update_data for updating the existing event and saving it in database
     * Create a session for event(record_id)
     * return to program.update page if authorized else return back
     */
    public function openEvent($code)
    {
        // Update in a database
        $result=ProgramRecord::where('code',$code)->first();
        if($result)
        {
            if($result['upload_id']==Auth::guard('teacher')->user()['id'])
            {
                //Session create record_id
                Session::put('record_id',$result->id);
                $start=$result['start'];
                $end = unserialize($result['endtime']);
                $end = $this->dateConversion($end['enddate']).$this->timeConversion($end['endtime']);
                date_default_timezone_set('Asia/Kolkata');
                $time = date("YmdHi",time());
                if($start>$time)
                {
                    $timing="0";
                    $class="Info";
                    $mess="Update the event";
                }
                elseif ($time>=$start && $time<=$end) {
                    $timing="1";
                    $class="Warning";
                    $mess="Event is started, You cant update the event";
                }
                else
                {
                    $timing="-1";
                    $class="Danger";
                    $mess="Event is ended, Thank You";
                }
                return view('program.update')->with('message',[$mess,$class,$timing]);
            }
            return Redirect::back()->with(['message' => 'Invalid Authentication' , 'class' => 'Warning']);
        }

        return Redirect::back()->with(['message' => 'Incorrect program code' , 'class' => 'Danger']);
    }

    /**
     * function program_details for creating programs for the event and saving it to database
     * return back if successfully saved for adding more programs to event else return back for removing errors
     */
    public function programDetails(Request $request)
    {
        // Validation
        $this->validate($request,[
            'program_name' => 'required|max:255|',
            'program_statement' => 'required|',
            'testcases_input' =>'required',
            'testcases_output' => 'required',
            'time' => 'required',
            'marks' => 'required'
        ]);

        // Input
        $pg=Input::all();

        // Save to DB
        $prg= new Program_Details;
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
        $prg->record_id=Session::get('record_id');
        if($prg->save())
        {
            if($pg['decide']=='1')
                return Redirect::back()->with(['message' => 'Program is uploaded!!' , 'class' => 'Success']);
            $code=ProgramRecord::find(Session::get('record_id'));
            $code=$code->code;
            return Redirect::to('update/'.$code)->with(['message' => 'Program is uploaded!!' , 'class' => 'Success']);
        }

        return Redirect::back()->with(['message' => 'Program failed to upload' , 'class' => 'Danger']);
    }

        /**
     * function updateProgram for updating programs for the event and saving it to database
     * return to program.updateProgram else return to error not found page
     */
    public function updateProgram($code,$id)
    {
        $result=Program_Details::find($id);
        if(Session::get('record_id')==$result['record_id'])
        {
            return View('program.updateProgram')->with('data',$result);
        }
        return View("errors.503");
    }

    /**
     * function programUpdateDone for saving programs for the event
     * return to program.update else return back with error
     */
    public function ProgramUpdateDone()
    {
        //Get Input
        $result=Input::all();
        //Update data in DB
        $prg= Program_Details::find($result['id']);
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
        $prg->record_id=Session::get('record_id');
        if($prg->save())
        {
            // return Redirect::to('program')->with('message','Program is updated!');
            // return view('program.update')->with('message','Program is updated!');
            $code=ProgramRecord::find(Session::get('record_id'));
            $code=$code->code;
            return Redirect::to('update/'.$code)->with(['message' => 'Program is updated!!' , 'class' => 'Success']);
        }
        else
        {
            return Redirect::back()->with(['message' => 'Error in updating program, Try Again' , 'class' => 'Danger']);
        }

    }

    public function eventdetails()
    {
        $result = ProgramRecord::find(Session::get('record_id'));
        $start = unserialize($result['starttime']);
        $end = unserialize($result['endtime']);
        $result['startdate'] = $start['startdate'];
        $result['starttime'] = $start['starttime'];
        $result['enddate'] = $end['enddate'];
        $result['endtime'] = $end['endtime'];
        return view('program.eventdetails')->with('data',$result);
    }

    public function eventsave(Request $request,$code)
    {
        $this->validate($request,[
            'name' => 'required|max:255|',
            'description' => 'required',
            'starttime' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'endtime' => 'required',
        ]);

        $record = Input::all();

        $rec = ProgramRecord::where('code',$code)->first();

        $eventStart = array('startdate' => $record['startdate'] , 'starttime' => $record['starttime'] );
        $eventEnd = array('enddate' => $record['enddate'] , 'endtime' => $record['endtime'] );

        $start = $this->dateConversion($record['startdate']).$this->timeConversion($record['starttime']);
        $end = $this->dateConversion($record['enddate']).$this->timeConversion($record['endtime']);
        date_default_timezone_set('Asia/Kolkata');
        $time = $rec->start;
        // return $start-$time;

        if($end-$start >= 100 && $start-$time >=0)
        {
            // Save to database
            $rec->name=$record['name'];
            $rec->description=$record['description'];
            $rec->instructions=$record['instructions'];
            $rec->starttime=serialize($eventStart);
            $rec->endtime=serialize($eventEnd);
            $rec->start=$start;
            if($rec->save())
            {
                return Redirect::to('update/'.$code)->with(['message' => 'Record is successfully saved' , 'class' => 'Success']);
            }
            return Redirect::back()->with(['message' => 'Record is failed' , 'class' => 'Danger'])->withInput();
        }
        else
        {
            $errors=new MessageBag(['startdate' => ['Event must be start before the end time'], 'enddate' => ['Event must be end after the start time']]);
            return Redirect::back()->withErrors($errors)->withInput()->with(['message' => 'Enter correct time, Event must be started after 24 hours from now' , 'class' => 'Warning']);
        }
    }

    public function delete(Request $request,$id)
    {
        // $del=ProgramRecord::find($id);
        if($id==Session::get('record_id'))
        {
            $del=ProgramRecord::find($id);
            // return $del;
            $del->delete();
            // ProgramRecord::destroy($id);
            // if($)
            return Redirect::to('home')->with(['message' => 'Event is successfully deleted' , 'class' => 'Success']);
        }
    }

    public function checkCode(Request $request,$code)
    {
        // echo $code;
        if(ProgramRecord::where('code',$code)->first())
        {
            $errors=new MessageBag(['code' => ['Password Invalid']]);
            echo $errors;
        }
        else
        {
            echo "false";
        }

    }

    /**
     * function program_input for checking the active session of the Teacher and record_id to make him input the details of the programs
     */
    public function program_input()
    {
        return view('program.input');
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
