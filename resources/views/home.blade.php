<?php
use App\programRecord;
if(Auth::guard('student')->check()):
    $result = Auth::guard('student')->user();
    $programList=programRecord::all();
elseif (Auth::guard('admin')->check()):
    $result = Auth::guard('admin')->user();
    $programList=programRecord::all();
else:
    $result = Auth::guard('teacher')->user();
    $programList=programRecord::where('upload_id',$result->id)->orderBy('start','asc')->get();
endif;

?>

@extends('layouts.layout')
    @section('body')
        <div class="custom-flash {{ Session::get('class') }} ">{{ Session::get('message') }}</div>
    @endsection
    @section('content')
        <div class='container-fluid '>

          <div class="row">

            <!-- @include('master.sidebar') -->


            <div class="col-xs-12 col-sm-9 col-md-10">
                @if(Auth::guard('admin')->check())
                    @include('admin.adminEvents')
                @elseif(Auth::guard('teacher')->check())
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
