<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;


use Redirect;

use App\Student;
use App\Student_Details;
use Illuminate\Support\MessageBag;

class StudentController extends Controller
{
    public function login(Request $request)
    {

        // $errors = new MessageBag;

        $this->validate($request,[
            'admision_no' => 'required|max:255|',
            'password' => 'required|',
        ]);


        // return student::find(1)->id;
        $slogin=array(
            'admision_no'=>Input::get('admision_no'),
            'password'=>Input::get('password'));

        $result=Student::where('admision_no',$slogin["admision_no"])->first();
        // return $result;
    	if($result)
    	{
            if(Hash::check($slogin['password'], $result->password))
            {

        		$request->session()->put('start',$result->id);
                $request->session()->put('type','student');

    		    return Redirect::to('home');
            }

            $errors=new MessageBag(['password' => ['Password Invalid']]);
            return Redirect::back()->withErrors($errors)->with('message',"Invalid Credentials");
    	}

        $errors = new MessageBag(['admision_no' => ['Admission Number Invalid.']]); 
    	return Redirect::back()->withErrors($errors)->with('message',"Invalid Credentials");

    }

    public function register(Request $request)
    {

        $this->validate($request,[
            'name' => 'required|max:255',
            'admision_no' => 'required|max:255|unique:student',
            'password' => 'required|min:6|confirmed',
        ]);

    	$sregister=array('name'=> Input::get('name'), 
            'admision_no'=>Input::get('admision_no'),
    		'password'=> Hash::make(Input::get('password')));

        $student = new Student;
        $student->name = $sregister['name'];
        $student->admision_no = $sregister['admision_no'];
        $student->password = $sregister['password'];
        if($student->save())
        {
            $result=Student::where('admision_no',$sregister['admision_no'])->get();
            foreach ($result as $row) {
                $id=$row->id;
            }

            $student_details= new Student_details;
            $student_details->student_id = $id;
            $student_details->save();

            $request->session()->put('start',$id);
            $request->session()->put('type','student');

            return Redirect::to('home');
        }

        // student::create([
        //     'name'=>$sregister['name'],
        //     'admision_no'=>$sregister['admision_no'],
        //     'password'=>$sregister['password']
        //     ]);

    	// if($result=DB::insert('insert into student values(?,?,?,?,?,?)',[null,$sregister['name'],$sregister['admision_no'],$sregister['password'],null,null]))
    	// {
     //        $result=DB::table('student')->where([['admision_no',$sregister["admision_no"]],['password',$sregister['password']]])->value('id');
    		
     //        $request->session()->put('start',$result);
    	// 	return Redirect::to('home');
    	// }
    	return Redirect::back();	
    }


    public function stu_details(Request $request,$id)
    {
        $student_details=array('branch'=>'','year'=>'','email'=>'','mobile'=>'','gender'=>'');

        $this->validate($request,[
            'email' => 'email|max:255',
            'mobile' => '|max:10|min:10',
        ]);

        $request->flash();

        if($request->session()->has('start'))
        {
            $value=$request->session()->get('start');
            if($value==$id)
            {
                $result=Student_Details::where('student_id',$id)->first();
                // $result=student_details::find(1);
                // return $result;
                if($result!='[]')
                {

                    $student_details['branch']=Input::get('branch');
                    $student_details['year']=Input::get('year');
                    $student_details['email']=Input::get('email');
                    $student_details['mobile']=Input::get('mobile');
                    $student_details['gender']=Input::get('gender');

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

                    return Redirect::back()->withInput()->with('message','Profile is updated!!');
                }
            }

            return Redirect::to('home')->with('message','Invalid User');

        }

        return Redirect::to('login')->with('message','Login to update profile');
    }

}
