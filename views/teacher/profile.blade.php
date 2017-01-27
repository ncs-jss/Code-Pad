<?php
$result = Auth::guard('teacher')->user();
// var_dump(Session::get('class'));
?>
@extends('layouts.layout')
    @section('body')
        <div class="custom-flash {{ Session::get('class') }}">{{ Session::get('message') }}</div>
    @endsection
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
                        {!! Form::open(array('url'=>'users/' . Auth::guard('teacher')->user()->id, 'method'=>'PUT', 'accept-charset'=>'UTF-8','files'=>true)) !!}
                        {{ csrf_field() }}
                            <div class="form row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                        <label for="department" class="control-label">Department</label>

                                        <input id="department" type="text" class="form-control" name="department" value="{{ $data['department'] }}">

                                        @if ($errors->has('department'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('department') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('position') ? 'has-error' : '' }}">
                                    <label for="position" class="control-label">Designation</label>

                                    <input id="position" type="text" class="form-control" name="position" value="{{ $data['position'] }}">

                                    @if ($errors->has('position'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('position') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                    <label for="mobile" class="control-label">Mobile No.</label>

                                    <input id="mobile" type="text" class="form-control" name="mobile" value="{{ $data['mobile'] }}">

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
                                            <label class="radio-inline"><input type="radio" name="gender" value="Male" {{ ($data['gender']=='Male') ? 'checked' :''}} >Male</label>
                                            <label class="radio-inline"><input type="radio" name="gender" value="Female" {{ ($data['gender']=='Female') ? 'checked' :''}} >Female</label>
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
    @section('footer')
        @include('master.foot')
    @endsection