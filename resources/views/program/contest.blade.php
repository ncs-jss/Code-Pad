<?php
use App\program_details;
use App\ProgramRecord;

$result = Auth::guard('student')->user();
$event=ProgramRecord::find(Session::get('record_id'));
$code=$event->code;
$details=Program_Details::where('record_id',Session::get('record_id'))->get();
    // echo $details;
?>
@extends('layouts.layout')

    @section('content')


        <div class="view-event container">
            <div class="event-info row">
                <div class="col-xs-12 col-sm-8">
                    <h1>{{ $event->name }}</h1>
                    <p> Description: {{ $event->description }}</p>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <a class="btn btn-success ldr-bd"> <span class="fa fa-users "></span> Show Leaderboard </a>
                </div>
            </div>
            <div class="view-event row">
                <!-- *** LEFT COLUMN *** -->
                <div class="col-sm-9 clearfix">
                    <?php
                        foreach($details as $key)
                        {
                    ?>
                            @include('master.programdetails')
                    <?php
                        }
                    ?>

                </div>
                <!-- /.col-md-9 -->

                <!-- *** LEFT COLUMN END *** -->


            </div>
            <!-- /.row -->
        </div>
    @endsection
