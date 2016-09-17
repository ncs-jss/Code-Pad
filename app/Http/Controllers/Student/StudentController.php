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
            return view('program.contest');
        }

        return Redirect::back()->with('message','Incorrect Event');
    }

    public function play(Request $request,$code,$id)
    {
        // return $code;
        $details=Program_Details::where('id',$id)->get()->first();
        // var_dump($details);
        // return $details;
        return view('program.program')->with('data',$details);
    }

}
