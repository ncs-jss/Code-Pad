<?php
use App\program_details;
use App\ProgramRecord;
use App\student;
use App\teacher;

if(Session::get('type')=='student')
{
    $result=student::find(Session::get('start'));
}
elseif (Session::get('type')=='teacher') {
    $result=teacher::find(Session::get('start'));
}

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

                    <!-- *** RIGHT COLUMN *** -->

                    <div class="col-xs-12 col-sm-3">
                        <!-- *** Side MENU *** -->
                        <div class="panel panel-default sidebar-menu">

                            <div class="panel-heading">
                                <h3 class="panel-title"> Do More: </h3>
                            </div>

                            <div class="panel-body">
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <a href="{{ url('program_input') }}"> <span class="fa fa-plus"></span> &nbsp; Add A New Program</a>
                                    </li>
                                    <li>
                                        <a href="#delete"  onclick="deleted()"><span class="fa fa-trash-o"></span> &nbsp; Delete This Event. </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/storage/app/record/'.$code.'.txt') }}" download="{{$code}}"><span class="fa fa-check-square-o"></span> &nbsp; Download this event result </a>
                                    </li>


                                </ul>

                            </div>
                        </div>

                        <!-- *** PAGES MENU END *** -->

                        <!-- /.banner -->
                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** RIGHT COLUMN END *** -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
    @endsection

    @section('script')
        <script type="text/javascript">
            function deleted() {
                var re = confirm("Are you really want to delete this event");
                if(re)
                {
                    location.href="{{ url('/delete/'.Session::get('record_id')) }}";
                }
            }
        </script>
    @endsection
