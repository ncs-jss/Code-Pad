<?php
$add='';
if(Auth::guard('admin')->check()):
    $result = Auth::guard('admin')->user();
    $add='admin';
else:
    $result = Auth::guard('teacher')->user();
endif;
?>
@extends('layouts.layout')

    @section('head')
    <style type="text/css">
        .custom_date_cell_table .ui-state-default {
            width: 2em;
        }
    </style>
    @endsection
    @section('body')
        <div class="custom-flash {{ Session::get('class') }}">{{ Session::get('message') }}</div>
    @endsection
    @section('content')

        <section>
            <div class="container-fluid">

                <div class="theme-form row">

                    <div class="col-sm-6 col-sm-offset-3 ">
                        <div>
                            <h2> Insert Details </h2>
                            <hr>
                        </div>
                    </div>

                    <div class="col-sm-6 col-sm-offset-3">
                        <form  role="form" method="POST" action="{{ url($add.'/'.$data['code'].'/event-details/') }}">
                            {{ csrf_field() }}

                            <div class="form row">

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name">Name of the Event</label>
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $data['name'] }}" placeholder="Practice or Competition">

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label for="description" >Description of the Event</label>
                                        <textarea class="form-control" rows="5" name="description" data-provide="markdown" id="description">{{ $data['description'] }}</textarea>

                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('instructions') ? ' has-error' : '' }}">
                                        <label for="instructions" >Instructions (optional)</label>
                                        <textarea class="form-control" rows="5" name="instructions" id="instructions">{{ $data['instructions'] }}</textarea>

                                        @if ($errors->has('instructions'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('instructions') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-sm-6">
                                    <div class="form-group{{ ($errors->has('starttime')||$errors->has('startdate')) ? ' has-error' : '' }}">
                                        <label>Event Start</label>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <input id="startdate" type="text" class="form-control" name="startdate" value="{{ $data['startdate'] }}" placeholder="Start Date">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input id="starttime" type="text" class="form-control time" name="starttime" value="{{ $data['starttime'] }}" placeholder="Start Time">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($errors->has('starttime') || $errors->has('startdate'))
                                            <span class="help-block">
                                                <strong>Event Start fields are required</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-sm-6">
                                    <div class="form-group{{ ($errors->has('endtime')||$errors->has('enddate')) ? ' has-error' : '' }}">
                                        <label>Event End</label>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <input id="enddate" type="text" class="form-control" name="enddate" value="{{ $data['enddate'] }}" placeholder="End Date">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input id="endtime" type="text" class="form-control time" name="endtime" value="{{ $data['endtime'] }}" placeholder="End Time">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($errors->has('endtime')||$errors->has('enddate'))
                                            <span class="help-block">
                                                <strong>End Time fields are required</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check-square-o"></i>Save Details
                                        </button>
                                    </div>
                                </div>

                                <!-- <div class="col-sm-12">
                                    <a type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Submit </a>
                                    <a class="btn btn-default"><i class="fa fa-ban"></i> Cancel </a>
                                </div> -->
                            </div>
                              <!-- /.row -->
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
    @endsection


    @section('script')
        <script type="text/javascript" src="{{ URL::asset('public/assets/js/codeCheck.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('public/jquery-ui-1.12.0.custom/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('public/jquery-ui-timepicker/jquery.ui.timepicker.css')}}">
        <script src="{{ URL::asset('public/jquery-ui-1.12.0.custom/jquery-ui.min.js')}}"></script>
        <script src="{{ URL::asset('public/jquery-ui-timepicker/jquery.ui.timepicker.js') }}"></script>
        <script type="text/javascript">
            $( function() {
                $( "#startdate" ).datepicker();
                $( "#enddate" ).datepicker();
                $('#starttime').timepicker({
                    showPeriod: true,
                    showLeadingZero: true
                });

                $('#endtime').timepicker({
                    showPeriod: true,
                    showLeadingZero: true
                });
                $(".time").on('focus keyup',function() {
                    $(".ui-timepicker-table").addClass('custom_date_cell_table');
                });
            });
            CKEDITOR.replace('description');
            CKEDITOR.replace('instructions');

        </script>

    @endsection
