<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Teacher;

use App\Teacher_Details;

use Validator;
use DB;
use Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;


class TeacherController extends Controller
{
    public function login(Request $request)
    {

        $this->validate($request,[
            'email' => 'required|email|max:255|',
            'password' => 'required|',
        ]);


        $tlogin=array(
            'email'=>Input::get('email'),
            'password'=>Input::get('password'));

        $result=Teacher::where('email',$tlogin["email"])->first();
    	if($result)
    	{
            if(Hash::check($tlogin['password'], $result->password))
            {
                $request->session()->put('start',$result->id);
                $request->session()->put('type','teacher');

                return Redirect::to('home');
            }

            $errors = new MessageBag(['password'=>['Invalid Password']]);

            return Redirect::back()->withErrors($errors);  
    		
    	}

    	$errors = new MessageBag(['email'=>['Invalid Email Id']]);

        return Redirect::back()->withErrors($errors); 	
    }



    public function register(Request $request)
    {

        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:teacher',
            'password' => 'required|min:6|confirmed',
        ]);

    	$tregister=array('name'=> Input::get('name'), 
            'email'=>Input::get('email'),
    		'password'=> Hash::make(Input::get('password')));

        $teacher = new Teacher;
        $teacher->name = $tregister['name'];
        $teacher->email = $tregister['email'];
        $teacher->password = $tregister['password'];
        if($teacher->save())
        {
            $result=Teacher::where('email',$tregister['email'])->get();
            foreach ($result as $row) {
                $id=$row->id;
            }

            $teacher_details= new Teacher_Details;
            $teacher_details->teacher_id = $id;
            $teacher_details->save();

            $request->session()->put('start',$id);
            $request->session()->put('type','teacher');
            
            return Redirect::to('home');
        }

    	return Redirect::back();	
    }


    public function tea_details(Request $request,$id)
    {
        $tea_details=array('department'=>'','position'=>'','mobile'=>'','gender'=>'');

        $this->validate($request,[
            'mobile' => '|max:10|min:10',
        ]);
        

        if($request->session()->has('start'))
        {
            $request->flash();

            $value=$request->session()->get('start');
            if($value==$id)
            {
                $result=Teacher_Details::where('teacher_id',$id)->first();
                // $result=student_details::find(1);
                // return $result;
                if($result!='[]')
                {

                    $teacher_details['department']=Input::get('department');
                    $teacher_details['position']=Input::get('position');
                    $teacher_details['mobile']=Input::get('mobile');
                    $teacher_details['gender']=Input::get('gender');

                    if($teacher_details['department'])
                        $result->department=$teacher_details['department'];
                    if($teacher_details['position'])
                        $result->position=$teacher_details['position'];
                    if($teacher_details['mobile'])
                        $result->mobile=$teacher_details['mobile'];
                    if($teacher_details['gender'])
                        $result->gender=$teacher_details['gender'];
                    $result->save();


                    return Redirect::back()->withInput()->with('message','Profile is updated!!');
                }
            }

            return Redirect::to('home')->with('message','Invalid User');

        }

        return Redirect::to('tlogin')->with('message','Login to update profile');
    }


}
