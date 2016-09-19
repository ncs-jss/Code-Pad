<?php
use App\program_details;
use App\ProgramRecord;
$add='';
if(Auth::guard('admin')->check()):
    $result = Auth::guard('admin')->user();
    $add='admin';
else:
    $result = Auth::guard('student')->user();
endif;
$event=ProgramRecord::find(Session::get('record_id'));
$event['starttime'] = unserialize($event['starttime']);
$event['endtime'] = unserialize($event['endtime']);
$code=$event->code;
$details=Program_Details::where('record_id',Session::get('record_id'))->get();
?>
@extends('layouts.layout')
    @section('body')
        <div class="custom-flash {{ $message['class'] }} ">{{ $message['message'] }}</div>
    @endsection
    @section('content')
    <section>
        <div class="container-fluid">
            <div class="row">

                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="container-fluid">
                        <div class="register-event row">

                          <div class="col-xs-12 text-center">
                              <h1>{{ $event->name }}</h1>
                          </div>

                          <div class="col-sm-8 col-sm-push-2">
                              <p> <strong> Description: </strong>{!!$event->description!!}</p>
                              <p> <strong> Instructions: </strong>{!!$event->instructions!!}</p>
                          </div>

                          <div class="col-sm-12 text-center">
                              <a class="btn btn-success ldr-bd"><span class="fa fa-users"></span> Show Leaderboard </a>
                              <p><i class="fa fa-calendar-o"></i>{{$event['starttime']['startdate']}}</p>
                              <p>
                                  <strong> <span class="fa fa-clock-o"></span> {{$event['starttime']['starttime']." - ".$event['endtime']['endtime']}} </strong>
                              </p>
                          </div>

                          <div class="col-sm-6 col-sm-push-3">
                            <div class="countdown"></div>
                          </div>
                          @if($message['success']==0)
                          <div class="col-xs-12 text-center">
                            <a class="btn btn-success" href="{{ url('event/register/'.$code) }}">REGISTER</a>
                          </div>
                          @endif

                        </div>
                    </div>

                  </div>

            </div>
                <!-- /.row  -->
        </div>
            <!-- /. container -->
    </section>

    @endsection
    @section('footer')
        @include('master.foot')
    @endsection
    @section('script')
      <script>
          $('.countdown').ClassyCountdown({
            theme: "white",
            end: $.now() + {{$message['timer']}},

            // custom style for the countdown
            style: {
              days:    { gauge: { thickness: 0.08 } },
              hours:   { gauge: { thickness: 0.08 } },
              minutes: { gauge: { thickness: 0.08 } },
              seconds: { gauge: { thickness: 0.08 } }
            },
            });
      </script>
    @endsection
