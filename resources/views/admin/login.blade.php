@extends('admin.app')
    @section('content')
    <div class="ch-container">
        <div class="row">

            <div class="row">
                <div class="col-md-12 center login-header">
                    <h2>Welcome to Admin Login</h2>
                </div>
                <!--/span-->
            </div><!--/row-->

            <div class="row">
                <div class="well col-md-5 center login-box">
                    <div class="alert alert-info">
                        Please login with your Email and Password.
                    </div>
                    <!-- <form class="form-horizontal" action="{{ url('/admin_login') }}" method="post">
                     {{ csrf_field() }}
                        <fieldset>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                                <input type="text" class="form-control" placeholder="Username">
                            </div>
                            <div class="clearfix"></div><br>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend">
                                <label class="remember" for="remember"><input type="checkbox" id="remember"> Remember me</label>
                            </div>
                            <div class="clearfix"></div>

                            <p class="center col-md-5">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </p>
                        </fieldset>
                    </form> -->

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin_login') }}">
                                            {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                            <div class="col-sm-8 col-sm-push-2">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Id" >

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                            <div class="col-sm-8 col-sm-push-2">
                                                <input id="password" type="password" class="form-control" name="password" placeholder="Password">

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
                                            <div class="col-md-8 col-md-offset-2">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                                </button>

                                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </form>

                </div>
                <!--/span-->
            </div><!--/row-->
        </div><!--/fluid-row-->

    </div><!--/.fluid-container-->
    @endsection