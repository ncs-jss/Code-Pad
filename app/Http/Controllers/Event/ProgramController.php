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

class ProgramController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Program.Create');
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
        $prg->record_id=Session::get('record_id');
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
            return Redirect::to('events/'. $code)->with(
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arr = explode("-", $id);
        $id = $arr[1];
        $code = $arr[0];
        $details = ProgramDetails::where('id', $id)->get()->first();
        $details['code'] = $code;
        // return $details;
        if ($details) {
            return view('Program.Show')->with('data', $details);
        }
        return view("errors.503");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = ProgramDetails::find($id);
        if ($result) {
            return View('Program.Edit')->with('data', $result);
        }
        return view("errors.503");
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
        //Get Input
        $result=Input::all();
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
            return Redirect::to('events/' . $code)->with(
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
