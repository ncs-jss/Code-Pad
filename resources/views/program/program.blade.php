@extends('layouts.app')


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

<style>

body {
	margin: 0;
	padding: 0;
	background-color: black;
}


#program {
	background-color: black;
	outline: none;
	resize:none;
	border:none;
	width: 95%;
	margin: auto;
	height: 450px;
	color: white;
}

#black 
{
	background-color: black;
	border: none;
}

</style>
@endsection


@section('content')
<div class="container" >
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="black">
                <div class="panel-heading">Program</div><br>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/check') }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('program') ? ' has-error' : '' }}">

                            <div class="col-md-10 col-md-offset-1">
                                <textarea class="form-control" rows="5" name="program" id="program">{{ Session::get('snippet') }}</textarea>

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
					<div class="row">
						<div class="col-md-12">
							<pre class="prettyprint linenums">{{ htmlspecialchars(Session::get('snippet')) }}</pre>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('script')

{{Html::script('public/code-prettify-master/src/prettify.js')}}
<script type="text/javascript">
prettyPrint();
</script>

@endsection