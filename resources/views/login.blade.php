<!DOCTYPE html>
<html lang="en">
@include('master.header')

<body>

    <div id="all">

        <div id="background"></div>
        @include('master.navigation')


            <div class="container-fluid">
                <div class="row">
                    <div class="login col-xs-12 col-sm-6 col-sm-push-3 col-md-6 col-md-push-3 ">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active" ><a href="#student" aria-controls="student" role="tab" data-toggle="tab">Student</a></li>
                            <li role="presentation"><a href="#teacher" aria-controls="teacher" role="tab" data-toggle="tab">Teacher</a></li>
                        </ul>

                        <div class="tab-content" style="padding:0;">
                            <div role="tabpanel" class="tab-pane fade in active" id="student">
                                <div class="panel panel-default text-center" id="panel">
                                    <div class="panel-heading text-center">
                                        <h3>CodePad <small>logo</small></h3>
                                        <p id="typein">Type in your Admission No. and Password</p>
                                    </div>
                                    <div class="panel-body text-center">
                                        <p style="color:#a94442;">{{Session::get('message')}}</p>
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/student_login') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('admision_no') ? ' has-error' : '' }}">
                                                <label for="admision_no" class="col-md-4 control-label">Admission Number</label>

                                                <div class="col-md-6">
                                                    <input id="admision_no" type="admision_no" class="form-control" name="admision_no" value="{{ old('admision_no') }}">

                                                    @if ($errors->has('admision_no'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('admision_no') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label for="password" class="col-md-4 control-label">Password</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control" name="password">

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="remember"> Remember Me
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-8 col-md-offset-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-btn fa-sign-in"></i> Login
                                                    </button>

                                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
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
                                        <p id="typein">Type in your Email Id and Password</p>
                                    </div>
                                    <div class="panel-body text-center">
                                        <p style="color:#a94442;">{{Session::get('message')}}</p>
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/teacher_login') }}">
                                                    {{ csrf_field() }}
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email" class="col-md-4 control-label">Email ID</label>
                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label for="password" class="col-md-4 control-label">Password</label>
                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control" name="password">
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="remember"> Remember Me
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-8 col-md-offset-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-btn fa-sign-in"></i> Login
                                                    </button>

                                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
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
        @include('master.js')
    </div>
</body>

</html>
