@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Program Details</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/program_details') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6 col-md-offset-5" style="color:#429842;">{{Session::get('message')}}</div>
                        </div>
                        <br>

                        <div class="form-group{{ $errors->has('program_name') ? ' has-error' : '' }}">
                            <label for="program_name" class="col-md-2  control-label">Program Name</label>

                            <div class="col-md-9">
                                <input id="program_name" type="text" class="form-control" name="program_name" value="{{ old('program_name') }}" placeholder="Practice or Competition">

                                @if ($errors->has('program_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('program_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('program_statement') ? ' has-error' : '' }}">
                            <label for="program_statement" class="col-md-2 control-label">Question</label>

                            <div class="col-md-9">
                                <textarea class="form-control" rows="5" name="program_statement" id="program_statement">{{ old('program_statement') }}</textarea>

                                @if ($errors->has('program_statement'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('program_statement') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       

                        <div class="form-group{{ $errors->has('sample_input') ? ' has-error' : '' }}">
                            <label for="sample_input" class="col-md-2 control-label">Sample Input</label>

                            <div class="col-md-9">
                                <textarea class="form-control" rows="3" name="sample_input" id="sample_input">{{ old('sample_input') }}</textarea>

                                @if ($errors->has('sample_input'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sample_input') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group{{ $errors->has('sample_output') ? ' has-error' : '' }}">
                            <label for="sample_output" class="col-md-2 control-label">Sample Output</label>

                            <div class="col-md-9">
                                <textarea class="form-control" rows="3" name="sample_output" id="sample_output">{{ old('sample_output') }}</textarea>

                                @if ($errors->has('sample_output'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sample_output') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('testcases_input') ? ' has-error' : '' }}">
                            <label for="testcases_input" class="col-md-2 control-label">Test Case Input</label>

                            <div class="col-md-9">
                                <textarea class="form-control" rows="5" name="testcases_input" id="testcases_input">{{ old('testcases_input') }}</textarea>

                                @if ($errors->has('testcases_input'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('testcases_input') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('testcases_output') ? ' has-error' : '' }}">
                            <label for="testcases_output" class="col-md-2 control-label">Test Case Output</label>

                            <div class="col-md-9">
                                <textarea class="form-control" rows="5" name="testcases_output" id="testcases_output">{{ old('testcases_output') }}</textarea>

                                @if ($errors->has('testcases_output'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('testcases_output') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Done
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection