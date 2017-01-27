<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Http\Requests;
use Session;
use Redirect;
use App\programRecord;
use App\programDetails;
use App\Teacher;
use App\Student;

use App\Result;
use Validator;
use View;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\SoftDeletes;
use GuzzleHttp\Client;

class ProgramController extends Controller
{

    public function compile(Request $request, $code, $id)
    {
        $this->validate(
            $request,
            [
            'program' => 'required|',
            ]
        );

        $output = Input::all();
        // return $output;
        $output = strval($output['program']);
        // return var_dump($output);
        $client = new Client();
        $res = $client->request(
            'POST', 'http://api.hackerearth.com/v3/code/compile/',
            [
            'form_params' =>
                [
                'client_secret' => '856a3e481618e44697e683598ce8e99ee71c5fad',
                'async' => 0,
                'source'=> $output,
                'lang'=> "C",
                'time_limit'=> 5,
                'memory_limit'=> 262144,
                ]
            ]
        );
        // echo $res->getStatusCode();

         $result = $res->getBody();
        // dd($result);
         $result =  json_decode($result, true);
         // return $result;
        // $output = $result;
        return Redirect::back()->withInput()->with('res', $result);
    }




    public function runstatus(Request $request, $code, $id)
    {
        $this->validate(
            $request,
            [
            'program' => 'required|',
            ]
        );

        $record_id = ProgramRecord::where('code', $code)->first()->id; // Record Id
        $program_details = ProgramDetails::where(
            [
            [
            'record_id', $record_id
            ],
            [
            'id',$id
            ]
            ]
        )->first(); // Getting program details

        $inp = strip_tags($program_details['testcases_input']); //Getting Input
        $oup = strip_tags($program_details['testcases_output']); //Getting Output

        $coded = Input::all(); // Getting user input
        $output = strval($coded['program']); // Getting program
        $input = $inp;
        if ($coded['input'] != "") {
            if ($coded['name'] == "true") {
                $input = $coded['input'];
            }
        }

        $client = new Client(); // API
        $res = $client->request(
            'POST', 'http://api.hackerearth.com/v3/code/run/',
            [
            'form_params' =>
                [
                'client_secret' => '856a3e481618e44697e683598ce8e99ee71c5fad',
                'async' => 0,
                'source'=> $output,
                'input' => $input,
                'lang'=> "C",
                'time_limit'=> 5,
                'memory_limit'=> 262144,
                ]
            ]
        );

        $result = $res->getBody(); // Fetching API result

        $result =  json_decode($result, true);
        $result['input'] = $input;
        $result['expected_output'] = $oup;
        if (Auth::guard('student')->check()) {
            $event = Result::where(
                [
                [
                'record_id', $record_id
                ],
                [
                'student_id', Auth::guard('student')->user()->id
                ]
                ]
            )->first();
            $attempt = unserialize($event['attempt']);
        }
        if ($result['compile_status'] == 'OK') {
            $output = $result['run_status']['output'];
            $result['output'] = $output;
            $result['output_html'] = strip_tags($result['run_status']['output_html']);
            if ($result['expected_output'] == $result['output_html'] && Auth::guard('student')->check()) {

                if ($attempt['marks-'.$id] != $program_details['marks'] ) {

                    $event->score = $event->score - $attempt['marks-' . $id] + $program_details['marks'];
                    $attempt['marks-' . $id] = $program_details['marks'];
                    $attempt['done-' . $id] = 1;
                }
                $attempt['program-id' . $id] = $attempt['program-id' . $id] + 1;

                $event->attempt = serialize($attempt);
                $event->save();
            }
        }
        // return Auth::guard('student')->user();

         // return $result;
        return Redirect::back()->withInput()->with('out', $result);
    }

    public function writeFile()
    {
        Storage::append('record/PHPH.txt', "Ankit1");
    }

    public function leaderboard(Request $request, $code)
    {
        $id = ProgramRecord::where('code', $code)->first()->id;
        // return $id;
        $result = Result::where('record_id', $id)->orderBy('score', 'desc')->orderBy('updated_at', 'asc')->get();
        // return $result;

        foreach ($result as $key) {
            // code....
            $stdname = Student::find($key->student_id);
            $key['name']= $stdname->name;
        }
        return view('master.leaderboard')->with('data', $result);
    }

}
