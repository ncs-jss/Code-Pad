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
use GuzzleHttp\Client;

class ProgramController extends Controller
{


    // public function compile(Request $request)
    // {
    //     $this->validate($request,[
    //         'program' => 'required|',
    //     ]);

    //     $output = Input::all();
    //     $output = strval($output['program']);
    //     // return var_dump($output);
    //     $client = new Client();
    //     $res = $client->request('POST', 'http://api.hackerearth.com/v3/code/compile/', [
    //         'form_params' => [
    //             'client_secret' => '856a3e481618e44697e683598ce8e99ee71c5fad',
    //             'async' => 0,
    //             'source'=> $output,
    //             'lang'=> "C",
    //             'time_limit'=> 5,
    //             'memory_limit'=> 262144,
    //         ]
    //     ]);
    //     // echo $res->getStatusCode();

    //      $result= $res->getBody();
    //     // dd($result);
    //      $result =  json_decode($result, true);
    //      return $result;
    //     // $output = $result;
    //     return Redirect::back()->withInput()->with('res',$result);
    // }

    public function compile(Request $request,$code,$id)
    {
        $this->validate($request,[
            'program' => 'required|',
        ]);

        $output = Input::all();
        $output = strval($output['program']);
        // return var_dump($output);
        $client = new Client();
        $res = $client->request('POST', 'http://api.hackerearth.com/v3/code/compile/', [
            'form_params' => [
                'client_secret' => '856a3e481618e44697e683598ce8e99ee71c5fad',
                'async' => 0,
                'source'=> $output,
                'lang'=> "C",
                'time_limit'=> 5,
                'memory_limit'=> 262144,
            ]
        ]);
        // echo $res->getStatusCode();

         $result= $res->getBody();
        // dd($result);
         $result =  json_decode($result, true);
         // return $result;
        // $output = $result;
        return Redirect::back()->withInput()->with('res',$result);
    }




    public function runstatus(Request $request,$code,$id)
    {
        $this->validate($request,[
            'program' => 'required|',
        ]);

        $record_id = ProgramRecord::where('code',$code)->first()->id;
        // return $record_id;
        $program_details = Program_Details::where([['record_id',$record_id],['id',$id]])->first();
        // return $program_details;
        $inp = strip_tags($program_details['testcases_input']);
        $oup = strip_tags($program_details['testcases_output']);
        // return var_dump($oup);

        $coded = Input::all();
        $output = strval($coded['program']);
        $input = $inp;
        // return var_dump($output);
        $client = new Client();
        $res = $client->request('POST', 'http://api.hackerearth.com/v3/code/run/', [
            'form_params' => [
                'client_secret' => '856a3e481618e44697e683598ce8e99ee71c5fad',
                'async' => 0,
                'source'=> $output,
                'input' => $input,
                'lang'=> "C",
                'time_limit'=> 5,
                'memory_limit'=> 262144,
            ]
        ]);
        // echo $res->getStatusCode();

         $result= $res->getBody();
        // dd($result);

         $result =  json_decode($result, true);
         $result['input'] = $input;
         if($result['compile_status']=='OK')
         {
             $output = $result['run_status']['output'];
             $result['output'] = $output;
         }
         $result['expected_output'] = $oup;
         // return $output;
         // return $result;
        // $output = $result;
        return Redirect::back()->withInput()->with('out',$result);
    }

    public function writeFile()
    {
        Storage::append('record/PHPH.txt',"Ankit1");
    }

}
