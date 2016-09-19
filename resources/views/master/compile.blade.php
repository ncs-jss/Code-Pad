<!-- ===========================================================
                                          RESULT TABLE
============================================================= -->

<div class="segment">

  <div class="result">
    <!-- for wrong code add class "wrong" below -->
    <div class="correct">
      <p class="col-xs-12"> <strong> RESULT: </strong>
        @if(Session::get('res')['compile_status'] == 'OK')
        <span class="fa fa-check-circle"></span> Accepted
        @else
        <span class="fa fa-warning"></span> Error
        @endif
      </p>
      <!-- <p class="col-sm-4">
        <strong>Time(sec)</strong> <br> 0.0121
      </p>
      <p class="col-sm-4">
        <strong>Memory(KiB)</strong> <br> 92
      </p> -->
      <p class="col-sm-4">
        <strong>Language</strong> <br> C
      </p>
    </div>
  </div>


  <!-- <p>
    <strong>Your Code's Output: </strong> <br>
    <ul class="result-list">
      <li>3</li>
      <li>6</li>
    </ul>
  </p>
  <p>
    <strong> Expected Correct Output: </strong> <br>
    <ul class="result-list">
      <li>3</li>
      <li>7</li>
    </ul>
  </p> -->
  <p>
    <strong>Compilation Log </strong> <br>
    {{Session::get('res')['compile_status']}}
  </p>
</div>

<!-- ===========================================================
                                          RESULT TABLE  END
=============================================================