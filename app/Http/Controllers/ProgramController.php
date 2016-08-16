<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Http\Requests;
use Session;
use Redirect;
use App\programRecord;
use App\program_details;
use App\Teacher;
use Validator;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramController extends Controller
{
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
            'uploaded_by'=>'required'
        ]);

        // Get input
        $record=array('name'=>Input::get('name'),
        	'code'=>Input::get('code'),
        	'uploaded_by'=>Input::get('uploaded_by'));

        // Save to database
        $rec = new ProgramRecord;
        $rec->name=$record['name'];
        $rec->code=$record['code'];
        $rec->uploaded_by=$record['uploaded_by'];
        if($rec->save())
        {
        	$result=ProgramRecord::where('code',$record['code'])->first();

            // Session create
        	Session::put('record_id',$result->id);

            // Create a new file for that particular event with its unique code
            Storage::put('record/'.$record['code'].'.pdf','');
        	return Redirect::to('program_input')->with('message','Record is successfully saved');
        }

        return Redirect::back()->with('message','Record is failed');
    }

    /**
     * function update_data for updating the existing event and saving it in database
     * Create a session for event(record_id)
     * return to program.update page if authorized else return back
     */
    public function update_data($code)
    {

        // Update in a database
        $result=ProgramRecord::where('code',$code)->first();
        if($result)
        {
            $teacher=Teacher::find(Session::get('start'));
            if($result['uploaded_by']==$teacher->name)
            {
                //Session create record_id
                Session::put('record_id',$result->id);
                return view('program.update');
            }
            return Redirect::back()->with('error','You are not authorized to update this event');
        }

        return Redirect::back()->with('error','Incorrect Program Code');
    }


    /**
     * function program_details for creating programs for the event and saving it to database
     * return back if successfully saved for adding more programs to event else return back for removing errors
     */
    public function program_details(Request $request)
    {
        // Validation
        $this->validate($request,[
            'program_name' => 'required|max:255|',
            'program_statement' => 'required|',
            'testcases_input' =>'required',
            'testcases_output' => 'required'
        ]);

        // Get Input
        // $pg=array('program_name'=>Input::get('program_name'),
        //     'program_statement'=>Input::get('program_statement'),
        //     'sample_input'=>Input::get('sample_input'),
        //     'sample_output'=>Input::get('sample_output'),
        //     'testcases_input'=>Input::get('testcases_input'),
        //     'testcases_output'=>Input::get('testcases_output')
        // );

        $pg=Input::all();
        // array_pop($pg);
        // return $pg;

        // Save to DB
        $prg= new Program_Details;
        $prg->program_name = $pg['program_name'];
        $prg->program_statement = $pg['program_statement'];
        $prg->sample_input = $pg['sample_input'];
        $prg->sample_output = $pg['sample_output'];
        $prg->testcases_input = $pg['testcases_input'];
        $prg->testcases_output = $pg['testcases_output'];
        $prg->record_id=Session::get('record_id');
        if($prg->save())
        {
            if($pg['decide']=='1')
                return Redirect::back()->with('message','Program uploaded');
            $code=ProgramRecord::find(Session::get('record_id'));
            $code=$code->code;
            return Redirect::to('update/'.$code)->with('message','Program is updated');
        }

        return Redirect::back()->with('message','Program failed to upload');
    }

    /**
     * function snippet for
     */
    public function snippet()
    {
        $snippet=Input::get('program');
        Session::put('snippet',$snippet);
        return View('program.program');
    }

    /**
     * function updateProgram for updating programs for the event and saving it to database
     * return to program.updateProgram else return to error not found page
     */
    public function updateProgram($code,$id)
    {
        $result=Program_Details::find($id);
        if(Session::get('type')=='teacher' and Session::get('record_id')==$result['record_id'])
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
        $prg->sample_input = $result['sample_input'];
        $prg->sample_output = $result['sample_output'];
        $prg->testcases_input = $result['testcases_input'];
        $prg->testcases_output = $result['testcases_output'];
        $prg->record_id=Session::get('record_id');
        if($prg->save())
        {
            // return Redirect::to('program')->with('message','Program is updated!');
            // return view('program.update')->with('message','Program is updated!');
            $code=ProgramRecord::find(Session::get('record_id'));
            $code=$code->code;
            return Redirect::to('update/'.$code)->with('message','Program is updated');
        }
        else
        {
            return Redirect::back()->with('message','Error in updating program, Try Again');
        }

    }

    public function writeFile()
    {
        Storage::append('record/PHPH.txt',"Ankit1");
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

    public function delete(Request $request,$id)
    {
        // $del=ProgramRecord::find($id);
        if(Session::get('type')=='teacher' and $id==Session::get('record_id'))
        {
            $del=ProgramRecord::find($id);
            // return $del;
            $del->delete();
            // ProgramRecord::destroy($id);
            // if($)
            return Redirect::to('home')->with('message','Event is deleted');
        }
    }
}
