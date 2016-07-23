<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use Validator;
use Illuminate\Support\Facades\Input;

use Redirect;

use App\student;
use App\student_details;
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
            'password'=>md5(Input::get('password')));

        $result=student::where('admision_no',$slogin["admision_no"])->first();
        // return $result;
    	if($result)
    	{
            if($result->password==$slogin['password'])
            {

        		$request->session()->put('start',$result->id);
                $request->session()->put('type','student');

    		    return Redirect::to('home');
            }

            $errors=new MessageBag(['password' => ['Invalid Password']]);
            return Redirect::back()->withErrors($errors);   
    	}

        $errors = new MessageBag(['admision_no' => ['Admission Number invalid.']]); 
    	return Redirect::back()->withErrors($errors);	

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
    		'password'=> md5(Input::get('password')));

        $stu=new student;
        $stu->name = $sregister['name'];
        $stu->admision_no = $sregister['admision_no'];
        $stu->password = $sregister['password'];
        if($stu->save())
        {
            $result=student::where('admision_no',$sregister['admision_no'])->get();
            foreach ($result as $row) {
                $id=$row->id;
            }

            $st_details= new student_details;
            $st_details->student_id = $id;
            $st_details->save();

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
        $stu_details=array('branch'=>'','year'=>'','email'=>'','mobile'=>'','gender'=>'');

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
                $result=student_details::where('student_id',$id)->first();
                // $result=student_details::find(1);
                // return $result;
                if($result!='[]')
                {

                    $stu_details['branch']=Input::get('branch');
                    $stu_details['year']=Input::get('year');
                    $stu_details['email']=Input::get('email');
                    $stu_details['mobile']=Input::get('mobile');
                    $stu_details['gender']=Input::get('gender');

                    if($stu_details['branch'])
                        $result->branch=$stu_details['branch'];
                    if($stu_details['year'])
                        $result->year=$stu_details['year'];
                    if($stu_details['email'])
                        $result->email=$stu_details['email'];
                    if($stu_details['mobile'])
                        $result->mobile=$stu_details['mobile'];
                    if($stu_details['gender'])
                        $result->gender=$stu_details['gender'];
                    $result->save();

                    return Redirect::back()->withInput()->with('message','Profile is updated!!');
                }
            }

            return Redirect::to('home')->with('message','Invalid User');

        }

        return Redirect::to('login')->with('message','Login to update profile');
    }

}
