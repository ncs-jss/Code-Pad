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



@section('script')

@endsection

<!DOCTYPE html>
<html lang="en">

@include('master.header')
<body>

    <div id="all">

        @include('master.navigation')
        <!-- Create New  -->
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
                        <form  role="form" method="POST" action="{{ url('/record') }}">
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
                                    <div class="form-group{{ $errors->has('starttime') ? ' has-error' : '' }}">
                                        <label for="starttime">Start Time</label>
                                        <input id="starttime" type="datetime-local" class="form-control" name="starttime" value="{{ old('code') }}">

                                        @if ($errors->has('starttime'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('starttime') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('endtime') ? ' has-error' : '' }}">
                                        <label for="endtime">End Time</label>

                                        <input id="endtime" type="datetime-local" class="form-control" name="endtime" value="{{ old('code') }}">

                                        @if ($errors->has('endtime'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('endtime') }}</strong>
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
    </div>
    <!-- /#all -->

    @include('master.js')
    <script type="text/javascript" src="{{ URL::asset('public/assets/js/codeCheck.js') }}"></script>



</body>

</html>
