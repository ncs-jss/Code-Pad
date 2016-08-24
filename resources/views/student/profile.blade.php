<?php
use App\student;
use App\teacher;
use App\programRecord;

if(Session::get('type')=='student')
{
    $result=student::find(Session::get('start'));
}
elseif (Session::get('type')=='teacher') {
    $result=teacher::find(Session::get('start'));
    $programList=programRecord::where('uploaded_by',$result->name)->get();
}

?>
@extends('layouts.layout')

    @section('content')
        <section>
            <div class="container-fluid">
                <div class="theme-form row">
                    <div class="col-sm-6 col-sm-offset-3 ">
                        <div>
                            <h2> Edit Profile </h2>
                            <hr>
                        </div>
                    </div>

                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-5" style="color:#429842;">{{Session::get('message')}}
                            </div>
                        </div>

                        <form role="form" method="POST" action="{{ url('student_details/'.Session::get('start')) }}">
                                {{ csrf_field() }}
                            <div class="form row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
                                        <label for="branch" class="control-label">Branch</label>

                                        <input id="branch" type="text" class="form-control" name="branch" value="{{ old('branch') }}">

                                        @if ($errors->has('branch'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('branch') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                        <label for="year" class="control-label">Year</label>

                                        <input id="year" type="text" class="form-control" name="year" value="{{ old('year') }}">

                                        @if ($errors->has('year'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('year') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12 ">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="control-label">Email Id</label>

                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="mobile" class="control-label">Mobile No.</label>

                                        <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">

                                        @if ($errors->has('mobile'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                        <label for="gender" class="control-label">Gender</label>

                                        <div class="col-sm-offset-4">
                                            <label class="radio-inline"><input type="radio" name="gender" value="Male" {{ (old('gender')=='Male') ? 'checked' :''}} >Male</label>
                                            <label class="radio-inline"><input type="radio" name="gender" value="Female" {{ (old('gender')=='Female') ? 'checked' :''}} >Female</label>
                                            @if ($errors->has('gender'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Update </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endsection