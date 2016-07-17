<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Redirect;
use App\programRecord;
use App\program_details;
use Validator;
use Illuminate\Support\Facades\Input;

class ProgramController extends Controller
{
    
    function record(Request $request)
    {
    	$this->validate($request,[
            'name' => 'required|max:255|',
            'code' => 'required|max:20|unique:compiler_record',
            'uploaded_by'=>'required'
        ]);

        $record=array('name'=>Input::get('name'),
        	'code'=>Input::get('code'),
        	'uploaded_by'=>Input::get('uploaded_by'));

        // return $record;

        $rec = new programRecord;
        $rec->name=$record['name'];
        $rec->code=$record['code'];
        $rec->uploaded_by=$record['uploaded_by'];
        if($rec->save())
        {
        	$result=programRecord::where('code',$record['code'])->first();
        	$prg_details=new program_details;
        	$prg_details->record_id=$result->id;
        	$prg_details->save();

        	return Redirect::back()->with('message','Record is successfully saved');
        }

        return Redirect::back()->with('message','Record is failed');
    }
}
