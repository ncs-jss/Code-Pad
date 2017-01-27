<!-- ===========================================================
                                          RESULT TABLE
============================================================= -->

<div class="segment">

  <div class="result">
    <!-- for wrong code add class "wrong" below -->
    <div class="correct">
      <p class="col-xs-12"> <strong> RESULT: </strong>
        @if(Session::get('out')['compile_status'] == 'OK')
          <span class="fa fa-check-circle"></span> Accepted
        @else
          <span class="fa fa-warning"></span> Error
        @endif
      </p>
      <p class="col-sm-4">
        <strong>Time(sec)</strong> <br> {{ isset(Session::get('out')['run_status']['time_used']) ? Session::get('out')['run_status']['time_used'] : 'Undefined' }}
      </p>
      <p class="col-sm-4">
        <strong>Memory(KiB)</strong> <br>{{ isset(Session::get('out')['run_status']['memory_used']) ? Session::get('out')['run_status']['memory_used'] : 'Undefined'}}
      </p>
      <p class="col-sm-4">
        <strong>Language</strong> <br> C
      </p>
    </div>
  </div>

  <p>
    <strong>Input: </strong> <br>
    {{Session::get('out')['input']}}
  </p>
  <p>
    <strong>Your Code's Output: </strong> <br>
    <!-- <ul class="result-list"> -->
      <!-- <li>3</li> -->
      <!-- <li>6</li> -->
      @if(Session::get('out')['compile_status'] == 'OK')
        {!!Session::get('out')['output']!!}
      @endif
    <!-- </ul> -->
  </p>
  <p>
    <strong> Expected Correct Output: </strong> <br>
    <!-- <ul class="result-list">
      <li>3</li>
      <li>7</li>
    </ul> -->
    {{Session::get('out')['expected_output']}}
  </p>
  <p>
    <strong>Compilation Log </strong> <br> {{Session::get('out')['compile_status']}}
  </p>
</div>

<!-- ===========================================================
                                          RESULT TABLE  END
=============================================================