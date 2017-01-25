<?php

namespace App\Http\Controllers\Event;

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
use Storage;
use App\Student;
use App\ProgramRecord;
use App\ProgramDetails;
use App\Teacher;
use App\Admin;
use Illuminate\Support\MessageBag;

class EventController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('event', ['except' => ['index','show']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Event.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $this->validate(
            $request,
            [
            'name' => 'required|max:255|',
            'code' => 'required|max:20|unique:compiler_record',
            'description' => 'required',
            'starttime' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'endtime' => 'required',
            'uploaded_by'=>'required',
            'upload_id' => 'required',
            ]
        );


        $record = Input::all();
        // return $record;
        $eventStart = array(
            'startdate' => $record['startdate'],
            'starttime' => $record['starttime']
        );

        $eventEnd = array(
            'enddate' => $record['enddate'],
            'endtime' => $record['endtime']
        );

        // return substr($record['starttime'],-2);
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
        $time = date("YmdHi", time());
        // return $start-$time;
        if ($end - $start >= 100 && $start - $time >=0 ) {
            // Save to database
            $rec = new ProgramRecord;
            $rec->name = $record['name'];
            $rec->code = $record['code'];
            $rec->description = $record['description'];
            $rec->starttime = serialize($eventStart);
            $rec->endtime = serialize($eventEnd);
            $rec->start = $start;
            $rec->end = $end;
            $rec->uploaded_by = $record['uploaded_by'];
            $rec->upload_id = $record['upload_id'];
            if ($rec->save()) {
                $result = ProgramRecord::where(
                    'code', $record['code']
                )->first();

                // Session create
                Session::put('record_id', $result->id);

                // Create a new file for that particular event with its unique code
                Storage::put('record/' . $record['code'] . '.txt', '');

                return Redirect::to('events/' . $record['code'])->with(
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
     * Display the specified resource.
     *
     * @param  string $code
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        // Update in a database
        $result = ProgramRecord::where('code', $code)->first();
        if ($result) {
            //Session create record_id
            // return $result->id;
            $details = ProgramDetails::where('record_id', $result->id)->get();
            $details->event = $result;

            Session::put('record_id', $result->id);
            $start = $result['start'];
            $end = unserialize($result['endtime']);

            $end = $this->dateConversion(
                $end['enddate']
            ) . $this->timeConversion(
                $end['endtime']
            );

            date_default_timezone_set('Asia/Kolkata');
            $time = date("YmdHi", time());

            if ($start > $time) {
                $timing = "-1";
                $class = "Info";
                $mess = "Update the event";
            } elseif ($time >= $start && $time <= $end) {
                $timing = "-1";
                $class = "Warning";
                $mess = "Event is started, Update changes only that are necessary";
            } else {
                $timing = "-1";
                $class = "Danger";
                $mess = "Event is ended, Thank You";
            }
            return view('Event.Show')->with('message', [$mess, $class, $timing])->with('details', $details);
        }

        return Redirect::back()->with(
            [
            'message' => 'Incorrect program code',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = ProgramRecord::find(Session::get('record_id'));
        $start = unserialize($result['starttime']);
        $end = unserialize($result['endtime']);
        $result['startdate'] = $start['startdate'];
        $result['starttime'] = $start['starttime'];
        $result['enddate'] = $end['enddate'];
        $result['endtime'] = $end['endtime'];
        return view('Event.Edit')->with('data', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
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
        $time = date("YmdHi", time());
        // return $start-$time;

        if ($end-$start >= 100 && $start-$time >=0) {
            // Save to database
            $rec->name=$record['name'];
            $rec->description=$record['description'];
            $rec->instructions=$record['instructions'];
            $rec->starttime=serialize($eventStart);
            $rec->endtime=serialize($eventEnd);
            $rec->start=$start;
            $rec->end=$end;
            if ($rec->save()) {
                return Redirect::to('events/' . $code)->with(
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
            $errors=new MessageBag(
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == Session::get('record_id')) {
            $del = ProgramRecord::find($id);
            $del->delete();
            return Redirect::to('home')->with(
                [
                'message' => 'Event is successfully deleted',
                'class' => 'Success'
                ]
            );
        }
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
