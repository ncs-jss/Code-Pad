@extends('layouts.layout')
    @section('body')
        <div class="custom-flash {{ Session::get('class') }} ">{{ Session::get('message') }}</div>
        <div id="background"></div>
    @endsection

    @section('content')
            <div class="container-fluid">
                <div class="row">
                    <div class="login col-xs-12 col-sm-6 col-sm-push-3 col-md-6 col-md-4 col-md-push-4 ">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active" ><a href="#student" aria-controls="student" role="tab" data-toggle="tab">Student</a></li>
                            <li role="presentation"><a href="#teacher" aria-controls="teacher" role="tab" data-toggle="tab">Teacher</a></li>
                        </ul>

                        <div class="tab-content" style="padding:0;">
                            <div role="tabpanel" class="tab-pane fade in active" id="student">
                                <div class="panel panel-default text-center" id="panel">
                                    <div class="panel-heading text-center">
                                        <h3>CodePad <small>logo</small></h3>
                                    </div>
                                    <div class="panel-body text-center">
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/students') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">


                                                <div class="col-sm-10 col-sm-push-1">
                                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Your Name">

                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('admision_no') ? ' has-error' : '' }}">


                                                <div class="col-sm-10 col-sm-push-1">
                                                    <input id="admision_no" type="text" class="form-control" name="admision_no" value="{{ old('admision_no') }}" placeholder="Enter Admission No. e.g. 15CSE075">

                                                    @if ($errors->has('admision_no'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('admision_no') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                                <div class="col-sm-10 col-sm-push-1">
                                                    <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password">

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                                                <div class="col-sm-10 col-sm-push-1">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">

                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-btn fa-user"></i> Register
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="teacher">
                                <div class="panel panel-default text-center" id="panel">
                                    <div class="panel-heading text-center">
                                        <h3>CodePad <small>logo</small></h3>
                                    </div>
                                    <div class="panel-body text-center">
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/users') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">


                                                <div class="col-sm-10 col-sm-push-1">
                                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Your Name">

                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">


                                                <div class="col-sm-10 col-sm-push-1">
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email ID">

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">


                                                <div class="col-sm-10 col-sm-push-1">
                                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">


                                                <div class="col-sm-10 col-sm-push-1">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">

                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-btn fa-user"></i> Register
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
