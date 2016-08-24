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
                            <h2> Update A Program </h2>

                            <span>Update details for a program of your event below: </span>
                            <hr>
                        </div>
                    </div>

                    <div class="col-sm-6 col-sm-offset-3">

                        <form role="form" method="POST" action="{{ url('/programUpdate') }}">
                        {{ csrf_field() }}

                            <div class="form row">
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('program_name') ? ' has-error' : '' }}">
                                        <label for="program_name" class=" control-label">Program Name</label>


                                        <input id="program_name" type="text" class="form-control" name="program_name" value="{{ $data->program_name }}" placeholder="Practice or Competition">

                                        @if ($errors->has('program_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('program_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group{{ $errors->has('program_statement') ? ' has-error' : '' }}">
                                        <label for="program_statement" class="control-label">Question</label>


                                        <textarea class="form-control" rows="5" name="program_statement" id="program_statement">{{ $data->program_statement }}</textarea>

                                        @if ($errors->has('program_statement'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('program_statement') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('sample_input') ? ' has-error' : '' }}">
                                        <label for="sample_input" class="control-label">Sample Input</label>


                                        <textarea class="form-control" rows="3" name="sample_input" id="sample_input">{{ $data->sample_input }}</textarea>

                                        @if ($errors->has('sample_input'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sample_input') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('sample_output') ? ' has-error' : '' }}">
                                        <label for="sample_output" class="control-label">Sample Output</label>


                                        <textarea class="form-control" rows="3" name="sample_output" id="sample_output">{{ $data->sample_output }}</textarea>

                                        @if ($errors->has('sample_output'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sample_output') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group{{ $errors->has('testcases_input') ? ' has-error' : '' }}">
                                        <label for="testcases_input" class="control-label">Test Case Input</label>


                                        <textarea class="form-control" rows="5" name="testcases_input" id="testcases_input">{{ $data->testcases_input }}</textarea>

                                        @if ($errors->has('testcases_input'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('testcases_input') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group{{ $errors->has('testcases_output') ? ' has-error' : '' }}">
                                        <label for="testcases_output" class="control-label">Test Case Output</label>


                                        <textarea class="form-control" rows="5" name="testcases_output" id="testcases_output">{{ $data->testcases_output }}</textarea>

                                        @if ($errors->has('testcases_output'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('testcases_output') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <input type="hidden" name="id" id="id" value="{{ $data->id }}">



                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Update </button>
                                    <a class="btn btn-default" onclick=""><i class="fa fa-plus"></i> Delete </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endsection