<?php
/**
 * AdminController Class Doc Comment
 *
 * PHP version 5
 *
 * @category PHP
 * @package  CodePad
 * @author   Ankit Jain <ankitjain28may77@gmail.com>
 * @license  The MIT License (MIT)
 * @link     https://github.com/ncs-jss/Code-Pad
 */
namespace App\Http\Controllers\Admin;

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

/**
 * This controller handles the all the functionalities for the Admin User.
 *
 * @category PHP
 * @package  CodePad
 * @author   Ankit Jain <ankitjain28may77@gmail.com>
 * @license  The MIT License (MIT)
 * @link     https://github.com/ncs-jss/Code-Pad
 */
class AdminController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the all the functionalities for the Admin User.
    |
    */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }



    /**
     * Delete the Event
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Event ID
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        // $del=ProgramRecord::find($id);
        if ($id == Session::get('record_id')) {
            $del = ProgramRecord::find($id);
            // return $del;
            $del->delete();
            // ProgramRecord::destroy($id);
            // if($)
            return Redirect::to('home')->with(
                [
                'message' => 'Event is successfully deleted',
                'class' => 'Success'
                ]
            );
        }
    }

    /**
     * Check for the Existing Code during the Event Creation
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param string  $code    Contains the Code which needs to be checked
     *
     * @return \Illuminate\Http\Response
     */
    public function checkCode(Request $request, $code)
    {
        // echo $code;
        if (ProgramRecord::where('code', $code)->first()) {
            $errors = new MessageBag(
                [
                'code' => ['Password Invalid']
                ]
            );
            echo $errors;
        } else {
            echo "false";
        }
    }


    // /**
    //  * Shows the Contest Page
    //  *
    //  * @param string $code Contains the Event Code
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function contest($code)
    // {

    //     // Update in a database
    //     $result = ProgramRecord::where('code', $code)->first();
    //     if ($result) {
    //         Session::put('record_id', $result->id);
    //         $record = unserialize($result['endtime']);
    //         $end = $this->dateConversion(
    //             $record['enddate']
    //         ) . $this->timeConversion(
    //             $record['endtime']
    //         );
    //         date_default_timezone_set('Asia/Kolkata');
    //         $time = date("YmdHi", time());
    //         if ($result->start > $time) {
    //             return view('program.contest')->with(
    //                 'message',
    //                 [
    //                 'message' => 'Event is not started yet',
    //                 'class' => 'Warning',
    //                 'sussess' => 1
    //                 ]
    //             );
    //         } elseif ($end < $time) {
    //             return view('program.contest')->with(
    //                 'message',
    //                 [
    //                 'message' => 'Event is ended',
    //                 'class' => 'Info'
    //                 ]
    //             );
    //         }
    //         return view('program.contest')->with(
    //             'message',
    //             [
    //             'message' => 'Event is live!!',
    //             'class' => 'Success'
    //             ]
    //         );
    //     }

    //     return Redirect::back()->with('message', 'Incorrect Event');
    // }



    /**
     * Shows Add new Admin page
     *
     * @return \Illuminate\Http\Response
     */
    public function addAdmin()
    {
        return view('admin.addAdmin');
    }

    /**
     * Add new Admin Data in DB
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function addAdmindata(Request $request)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admin',
            'password' => 'required|min:6|confirmed',
            ]
        );

        $add = Input::all();

        $user = new Admin;
        $user->name = $add['name'];
        $user->email = $add['email'];
        $user->type = 0;
        $user->password =  Hash::make($add['password']);
        if ($user->save()) {
            return Redirect::to('/admin/Admin/Show')->with(
                [
                'message' => 'You have successfully added user',
                'class' => 'Success'
                ]
            );
        }
        return Redirect::back()->withInput()->with(
            [
            'message' => 'Error in registration, Please Try Again',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Shows Admin Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdmin(Request $request)
    {
        $result = Admin::where('type', 0)->get();
        $result->type = 'admin';
        return view('admin.showUser')->with('user', $result);
    }

    /**
     * Show Edit Admin Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Admin ID
     *
     * @return \Illuminate\Http\Response
     */
    public function editAdmin(Request $request, $id)
    {
        $result = Admin::find($id);
        if ($result->type == 0) {
            return view('admin.editUser')->with('user', $result);
        }
        return Redirect::back()->with(
            [
            'message' => 'Invalid Authorization',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Update the Admin Details or Credentials
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Admin ID
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAdmin(Request $request, $id)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            ]
        );
        $admin = Admin::find($id);

        $inp = Input::all();
        // return $inp;
        if ($inp['email'] != $admin->email) {
            $admin->email = $inp['email'];
        }
        if ($inp['password'] != "") {
            $this->validate(
                $request,
                [
                'password' => 'min:6|confirmed',
                ]
            );

            $admin->password = Hash::make($inp['password']);
        }

        $admin->save();
        return Redirect::back()->with(
            [
            'message' => 'successfully Done',
            'class' => 'Success'
            ]
        );
    }

    /**
     * Show Students Page
     *
     * @return \Illuminate\Http\Response
     */
    public function addStudent()
    {
        return view('admin.addStudent');
    }

    /**
     * Add new Student Data in DB
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function addStudentdata(Request $request)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255',
            'admision_no' => 'required|max:255|unique:student',
            'password' => 'required|min:6|confirmed',
            ]
        );

        $add = Input::all();

        $user = new Student;
        $user->name = $add['name'];
        $user->admision_no = $add['admision_no'];
        $user->password =  Hash::make($add['password']);
        if ($user->save()) {
            return Redirect::to('/admin/Student/Show')->with(
                [
                'message' => 'You have successfully added user',
                'class' => 'Success'
                ]
            );
        }
        return Redirect::back()->withInput()->with(
            [
            'message' => 'Error in registration, Please Try Again',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Shows Student Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function showStudent(Request $request)
    {
        $result = Student::all();
        $result->type = 'student';
        return view('admin.showUser')->with('user', $result);
    }

    /**
     * Show Edit Student Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Student ID
     *
     * @return \Illuminate\Http\Response
     */
    public function editStudent(Request $request, $id)
    {
        $result = Student::find($id);
        $result['type'] = 'student';
        if ($result->type == 0) {
            return view('admin.editUser')->with('user', $result);
        }
        return Redirect::back()->with(
            [
            'message' => 'Invalid Authorization',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Update the Student Details or Credentials
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Student ID
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStudent(Request $request, $id)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255',
            'admision_no' => 'required',
            ]
        );
        $admin = Student::find($id);

        $inp = Input::all();
        // return $inp;
        if ($inp['admision_no'] != $admin->admision_no) {
            $admin->admision_no = $inp['admision_no'];
        }
        if ($inp['password'] != "") {
            $this->validate(
                $request,
                [
                'password' => 'min:6|confirmed',
                ]
            );

            $admin->password = Hash::make($inp['password']);
        }
        if ($admin->save()) {
            return Redirect::back()->with(
                [
                'message' => 'successfully Done',
                'class' => 'Success'
                ]
            );
        } else {
            return Redirect::back()->with(
                [
                'message' => 'Error in updating',
                'class' => 'Danger'
                ]
            );
        }
    }

    /**
     * Show Teacher Page
     *
     * @return \Illuminate\Http\Response
     */
    public function addTeacher()
    {
        return view('admin.addTeacher');
    }

    /**
     * Add new Teacher Data in DB
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function addTeacherdata(Request $request)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:teacher',
            'password' => 'required|min:6|confirmed',
            ]
        );

        $add=Input::all();

        $user = new Teacher;
        $user->name = $add['name'];
        $user->email = $add['email'];
        $user->password =  Hash::make($add['password']);
        if ($user->save()) {
            return Redirect::to('/admin/Teacher/Show')->with(
                [
                'message' => 'You have successfully added user',
                'class' => 'Success'
                ]
            );
        }
        return Redirect::back()->withInput()->with(
            [
            'message' => 'Error in registration, Please Try Again',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Shows Teacher Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function showTeacher(Request $request)
    {
        $result = Teacher::all();
        $result->type = 'teacher';
        return view('admin.showUser')->with('user', $result);
    }

    /**
     * Show Edit Teacher Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Teacher ID
     *
     * @return \Illuminate\Http\Response
     */
    public function editTeacher(Request $request, $id)
    {
        $result = Teacher::find($id);
        $result['type'] = 'teacher';
        if ($result->type == 0) {
            return view('admin.editUser')->with('user', $result);
        }
        return Redirect::back()->with(
            [
            'message' => 'Invalid Authorization',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Update the Teacher Details or Credentials
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Teacher ID
     *
     * @return \Illuminate\Http\Response
     */
    public function updateTeacher(Request $request, $id)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255',
            'email' => 'required',
            ]
        );
        $admin = Teacher::find($id);

        $inp = Input::all();
        // return $inp;
        if ($inp['email'] != $admin->email) {
            $admin->email = $inp['email'];
        }
        if ($inp['password']!="") {
            $this->validate(
                $request,
                [
                'password' => 'min:6|confirmed',
                ]
            );

            $admin->password = Hash::make($inp['password']);
        }
        if ($admin->save()) {
            return Redirect::back()->with(
                [
                'message' => 'successfully Done',
                'class' => 'Success'
                ]
            );
        } else {
            return Redirect::back()->with(
                [
                'message' => 'Error in updating',
                'class' => 'Danger'
                ]
            );
        }
    }
}
