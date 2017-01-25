<?php
$event = $details->event;
$code = $event->code;
?>

@extends('layouts.layout')
    @section('body')
        <div class="custom-flash {{ $message[1] }} ">{{ $message[0] }}</div>
    @endsection
    @section('content')
        <div class="view-event container">
                <div class="event-info row">
                    <div class="col-xs-12 col-sm-8">
                        <h1>{{ $event->name }}</h1>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                      <a class="btn btn-success ldr-bd" href="{{ url('leaderboard/'.$code) }}"> <span class="fa fa-users "></span> Show Leaderboard </a>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <p><div><strong>Description:</strong>{!!$event->description!!}</div></p>
                        <p><div><strong>Instructions:</strong>{!!$event->instructions!!}</div></p>

                    </div>

                    <div class="col-xs-12 col-sm-4">
                        <div class="panel panel-default sidebar-menu">

                            <div class="panel-heading">
                                <h3 class="panel-title"> Do More: </h3>
                            </div>

                            <div class="panel-body">
                                <ul class="nav nav-pills nav-stacked">
                                    @if($message[2]!=1)
                                    <li>
                                        <a href="{{ url('/events/' . $code . '/edit') }}"> <span class="fa fa-plus"></span> &nbsp; Insert Details</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/event/programs/create') }}"> <span class="fa fa-plus"></span> &nbsp; Add A New Program</a>
                                    </li>
                                    <li>
                                        <a href="#delete"  onclick="deleted()"><span class="fa fa-trash-o"></span> &nbsp; Delete This Event. </a>
                                    </li>
                                    @endif
                                    @if($message[2]==-1)
                                    <li>
                                        <a href="{{ url('/storage/app/record/'.$code.'.txt') }}" download="{{$code}}"><span class="fa fa-check-square-o"></span> &nbsp; Download this event result </a>
                                    </li>
                                    @endif


                                </ul>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="view-event row">
                    <!-- *** LEFT COLUMN *** -->

                    <div class="col-sm-8 clearfix">
                            @foreach($details as $key)
                                @include('master.programdetails')
                            @endforeach
                    </div>
                    <!-- /.col-md-9 -->

                    <!-- *** LEFT COLUMN END *** -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
    @endsection
    @section('footer')
        @include('master.foot')
    @endsection
    @section('script')
        <script type="text/javascript">
            function deleted() {
                var re = confirm("Are you really want to delete this event");
                if(re)
                {
                    location.href="{{ url('events/' . $code) }}";
                }
            }
        </script>
    @endsection
