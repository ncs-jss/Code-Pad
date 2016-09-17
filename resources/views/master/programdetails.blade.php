<section>
  <div class="panel-group" id="accordion">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#{{ $key->id }}">
            {{ $key->program_name }}( click to see details )
          </a>
          @if(Auth::guard('admin')->check())
            <a class="pull-right" href="{{ url($add.'/update/').'/'.$code.'/'.$key->id }}"> Edit </a>
            <a class="pull-right" href="{{ url($add.'/check/') }}"> Solve </a>
          @elseif(Auth::guard('teacher')->check())
            <a class="pull-right" href="{{ url('update/').'/'.$code.'/'.$key->id }}"> Edit </a>
          @else
            <a class="pull-right" href="{{ url('check/') }}"> Solve </a>
          @endif
        </h4>
      </div>
      <div id="{{ $key->id }}" class="panel-collapse collapse">
        <div class="panel-body">
          <p>
            <span>
              <p class="pull-left"><strong>Difficulty:</strong> {{$key->difficulty}}</p>
              <p class="pull-right"><strong>Marks:</strong> {{$key->marks}} </p>
            </span><br style="clear:both;">
            <strong>Question: </strong> {{ $key->program_statement }} <br><br>
            <strong> Sample Input : </strong> {{ $key->sample_input }}<br><br>
            <strong> Sample Output : </strong> {{ $key->sample_output }} <br><br>
            <!-- <strong> Test Case Input : </strong> {{ $key->testcases_input }}<br><br>
            <strong> Test Case Output : </strong> {{ $key->testcases_output }}<br><br> -->
          </p>
        </div>
      </div>
    </div>
    <!-- /.panel -->
  </div>
  <!-- /.panel-group -->
  <!-- <p class="text-muted"> Random text.</p> -->
</section>