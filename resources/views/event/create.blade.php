<?php
if(Auth::guard('admin')->check())
    $result = Auth::guard('admin')->user();
else
    $result = Auth::guard('teacher')->user();
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
                            <h2> Create An Event</h2>
                            <hr>
                        </div>
                    </div>

                    <div class="col-sm-6 col-sm-offset-3">
                        @if(Auth::guard('admin')->check())
                            <form  role="form" method="POST" action="{{ url('events') }}">
                        @else
                            <form  role="form" method="POST" action="{{ url('/events') }}">
                        @endif
                            {{ csrf_field() }}

                            <div class="form row">

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name">Name of the Event</label>
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Practice or Competition">

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>




                                <div class="col-sm-6">

                                    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}" id="codecheck">
                                        <label for="code">Code of the Event</label>

                                         <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Must be Unique">

                                        @if ($errors->has('code'))
                                            <span class="help-block">
                                                <strong >{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label for="description" >Description of the Event</label>
                                        <textarea class="form-control" rows="5" name="description" id="description">{{ old('description') }}</textarea>

                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
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
                                                        <input id="startdate" type="text" class="form-control" name="startdate" value="{{ old('startdate') }}" placeholder="Start Date">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input id="starttime" type="text" class="form-control time" name="starttime" value="{{ old('starttime') }}" placeholder="Start Time">
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
                                                        <input id="enddate" type="text" class="form-control" name="enddate" value="{{ old('enddate') }}" placeholder="End Date">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input id="endtime" type="text" class="form-control time" name="endtime" value="{{ old('endtime') }}" placeholder="End Time">
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




                                <div class="col-sm-12">

                                    <div class="form-group{{ $errors->has('uploaded_by') ? ' has-error' : '' }}">
                                        <label for="uploaded_by">Uploaded By</label>

                                        <input id="uploaded_by" type="text" class="form-control" name="uploaded_by" value="{{ $result->name }}">

                                        @if ($errors->has('uploaded_by'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('uploaded_by') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>



                                <input type="hidden" id="upload_id" name="upload_id" value="{{ $result->id }}">
                                <!-- <input type="hidden" id="description2" name="description2" value="{{ $result->description2 }}"> -->
                                <br>



                                <!-- Submit -->
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check-square-o"></i>Create New Event
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
        @include('master.foot')
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

           // new Editor($("description"), $("preview"));
           // $("#description").blur(function() {
           //      var converter = new showdown.Converter(),
           //      text = $("#description").val(),
           //      html      = converter.makeHtml(text);
           //      $("#description2").val(html);
           //      console.log(html);

           // });
           CKEDITOR.replace('description').config.toolbarLocation = 'bottom';
;

        </script>

    @endsection
