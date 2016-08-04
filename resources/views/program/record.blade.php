<?php
use App\student;
use App\teacher;

if(Session::get('type')=='student')
{
    $result=student::find(Session::get('start'));
}
elseif (Session::get('type')=='teacher') {
    $result=teacher::find(Session::get('start'));
}

?>

@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Program Record</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6 col-md-offset-4" style="color:#429842;">{{Session::get('message')}}</div>
                            <div class="col-md-6 col-md-offset-4" style="color:#d9534f;">{{Session::get('error')}}</div>

                        </div>
                        <br>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name of the Event</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Practice or Competition">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-4 control-label">Code of the Event</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Must be Unique">

                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       

                        <div class="form-group{{ $errors->has('uploaded_by') ? ' has-error' : '' }}">
                            <label for="uploaded_by" class="col-md-4 control-label">Uploaded By</label>

                            <div class="col-md-6">
                                <input id="uploaded_by" type="text" class="form-control" name="uploaded_by" value="{{ $result->name }}">

                                @if ($errors->has('uploaded_by'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('uploaded_by') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                               <div class="btn-group">
                                    <button type="button" name="new" onclick="sub()" class="btn btn-primary">New</button>
                                    <button type="button" name="update" onclick="upd()" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript">
function sub()
{
    document.querySelector("form").action="{{ url('/record') }}";
    document.querySelector("form").submit();
}

function upd()
{
    document.querySelector("form").action="{{ url('/update') }}";
    document.querySelector("form").submit();
}

</script>

@endsection