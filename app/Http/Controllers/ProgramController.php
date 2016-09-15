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




    public function contest($code)
    {

        // Update in a database
        $result=ProgramRecord::where('code',$code)->first();
        if($result)
        {
            Session::put('record_id',$result->id);
            return view('program.contest');
        }

        return Redirect::back()->with('message','Incorrect Event');
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





    public function writeFile()
    {
        Storage::append('record/PHPH.txt',"Ankit1");
    }




}
