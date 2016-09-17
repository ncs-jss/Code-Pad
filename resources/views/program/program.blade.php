<?php

$add='';
if(Auth::guard('admin')->check()):
    $result = Auth::guard('admin')->user();
    $add='admin';
else:
    $result = Auth::guard('student')->user();
endif;
// echo $data;
?>
@extends('layouts.layout')


@section('head')

{{Html::style('public/code-prettify-master/styles/sons-of-obsidian.css')}}
{{ Html::script('public/editarea_0_8_2/edit_area/edit_area_full.js') }}

<script type="text/javascript">
	editAreaLoader.init({
		id: "program"	// id of the textarea to transform
		,start_highlight: true	// if start with highlight
		,allow_resize: "both"
		,allow_toggle: true
		,word_wrap: true
		,language: "en"
		,syntax: "html"
		,toolbar: "search, go_to_line, |, fullscreen,|, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
		,syntax_selection_allow: "css,html,js,php,python,java,c,cpp,sql"
	});

	function clr()
	{
		editAreaLoader.setValue("program", "");
	}


</script>
@endsection


@section('content')
<section>
          <div class="container-fluid">

              <div class="editor row">

                <div class="col-sm-8 col-sm-push-2">

                  <div class="title segment">
                    <h1>{{ $data->program_name }}</h1>
                    <a class="btn btn-success ldr-bd pull-right"> <span class="fa fa-users "></span> Show Leaderboard </a>

                  </div>
                  <div class="segment">
                    <p>
                      <span class="col-xs-4 text-center"> <strong>Difficulty:</strong> {{$data->difficulty}}</span>
                      <span class="col-xs-4 text-center"> <strong>Time Limit:</strong> {{$data->time}} min </span>
                      <span class="col-xs-4 text-center"> <strong>Max Marks:</strong> {{$data->marks}} </span>
                    </p>
                  </div>
                  <div class="segment">
                    <p>
                      <strong>Problem Statement: </strong> <br>
                      <div>{!!$data->program_statement!!}</div>
                    </p>
                    <p>
                      <strong>Sample Input: </strong> <br>
                      <div>{!!$data->sample_input!!}</div>
                    </p>
                    <p>
                      <<strong>Sample Output: </strong> <br>
                      <div>{!!$data->sample_output!!}</div>
                    </p>
                    <p>
                      <strong> Explanation : </strong> <br>
                      <div>{!!$data->explanation!!}</div>
                    </p>
                  </div>
                  <div class="segment">
                    <!-- <p>
                      <strong>Test Case Input: </strong> <br>
                      {!!$data->testcases_input!!}
                    </p>
                    <p>
                      <strong>Test Case Output: </strong> <br>
                      {!!$data->testcases_output!!}
                    </p> -->
                    <p> <strong>Time Limit:</strong> {{$data->time}} min </p>
                    <p> <strong>Allowed Languages: </strong>C, CPP, sql, JS, php, python </p>
                  </div>
                  <div class="segment">

                    <h3>CODE EDITOR </h3>

                    <!-- <div class="code-editor">
                      <img src="editor.jpg" class="img-responsive" alt="">
                    </div> -->

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/check') }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('program') ? ' has-error' : '' }}">

                            <div class="col-md-10 col-md-offset-1">
                                <textarea class="form-control" rows="20" name="program" id="program">{{ Session::get('snippet') }}</textarea>

                                @if ($errors->has('program'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('program') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-success">Done</button>
                                    <button type="button" class="btn btn-danger" onclick='clr()'>Clear</button>
                                </div>
                            </div>
                        </div>
                    </form>

                  </div>

                </div>

              </div>
              <!-- /.row -->


          </div>
        </section>
@endsection


@section('script')

{{Html::script('public/code-prettify-master/src/prettify.js')}}
<script type="text/javascript">
prettyPrint();
</script>

@endsection