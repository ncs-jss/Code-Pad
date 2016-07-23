<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\teacher;

use App\teacher_details;

use Validator;
use DB;
use Redirect;

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
            'password'=>md5(Input::get('password')));

        $result=teacher::where('email',$tlogin["email"])->first();
    	if($result)
    	{
            if($result->password==$tlogin['password'])
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
    		'password'=> md5(Input::get('password')));

        $tea=new teacher;
        $tea->name = $tregister['name'];
        $tea->email = $tregister['email'];
        $tea->password = $tregister['password'];
        if($tea->save())
        {
            $result=teacher::where('email',$tregister['email'])->get();
            foreach ($result as $row) {
                $id=$row->id;
            }

            $tea_details= new teacher_details;
            $tea_details->teacher_id = $id;
            $tea_details->save();

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
                $result=teacher_details::where('teacher_id',$id)->first();
                // $result=student_details::find(1);
                // return $result;
                if($result!='[]')
                {

                    $tea_details['department']=Input::get('department');
                    $tea_details['position']=Input::get('position');
                    $tea_details['mobile']=Input::get('mobile');
                    $tea_details['gender']=Input::get('gender');

                    if($tea_details['department'])
                        $result->department=$tea_details['department'];
                    if($tea_details['position'])
                        $result->position=$tea_details['position'];
                    if($tea_details['mobile'])
                        $result->mobile=$tea_details['mobile'];
                    if($tea_details['gender'])
                        $result->gender=$tea_details['gender'];
                    $result->save();


                    return Redirect::back()->withInput()->with('message','Profile is updated!!');
                }
            }

            return Redirect::to('home')->with('message','Invalid User');

        }

        return Redirect::to('tlogin')->with('message','Login to update profile');
    }


}
