<?php
use App\program_details;
use App\ProgramRecord;

    $code=ProgramRecord::find(Session::get('record_id'));
    $code=$code->code;
    $result=Program_Details::where('record_id',Session::get('record_id'))->get();
    // $result=json_decode($result);
?>

@extends('layouts.app')

@section('head')
<style type="text/css">
    ul {
        list-style-type:none;
    }
    ul li a{
        padding:5px;
        display:block;
    }
</style>

@endsection

@section('content')
<div class="container-fluid">
    <div class="row"><br><br>
        <div class="col-md-6 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Click on the links to edit the program</div>
                <div class="panel-body">
                    <ul>
                        <?php
                        foreach ($result as $key) {
                            $link=url('/update')."/".$code.'/'.$key->id;
                            ?>
                            <li><a href="{{ $link }}">{{ $key->program_name }}</a></li>
                            <?php

                        }
                        ?>
                    </ul>
                    <br>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Operations</div>
                <div class="panel-body">
                    <ul >
                        <li><a href="{{ url('program_input') }}">Add More Programs</a></li>
                        <li><a href="{{ url('/delete/'.Session::get('record_id')) }}">Delete this Event</a></li>
                        <li><a href="">Show Leaderboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection