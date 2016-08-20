<?php
use App\programRecord;
use App\teacher;
use App\student;
    if(Session::get('type')=='teacher'):
        $result=teacher::find(Session::get('start'));
        $programList=programRecord::where('uploaded_by',$result->name)->get();
    else:
        $result=student::find(Session::get('start'));
        $programList=programRecord::all();
    endif
?>

@extends('layouts.layout')
    @section('content')
        <div class='container-fluid '>

          <div class="row">

            <!-- @include('master.sidebar') -->


            <div class="col-xs-12 col-sm-9 col-md-10">

                @if(Session::get('type')=='teacher')
                    @include('master.teacherEvents')
                @else
                    @include('master.studentEvents')
                @endif


            </div>
          </div>

        </div>
    @endsection

    @section('script')

        <script>
        $('.event-intro').enscroll({
          showOnHover: true,
          verticalTrackClass: 'track',
          verticalHandleClass: 'handle'
        });
        </script>
    @endsection
