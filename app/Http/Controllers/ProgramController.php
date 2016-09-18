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


    public function compile(Request $request)
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

    public function runstatus(Request $request)
    {
        $this->validate($request,[
            'program' => 'required|',
        ]);

        $coded = Input::all();
        $output = strval($coded['program']);
        $input = strval($coded['input']);
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
         // return $result;
        // $output = $result;
        return Redirect::back()->withInput()->with('run',$result);
    }





    public function writeFile()
    {
        Storage::append('record/PHPH.txt',"Ankit1");
    }




}
