<?php
use App\programRecord;
use App\teacher;
use App\student;
    if(Session::get('type')=='teacher'):
        $result=teacher::find(Session::get('start'));
        $programList=programRecord::where('uploaded_by',$result->name)->get();
    else:
        $result=student::find(Session::get('start'));
        $programList=programRecord::all();
    endif
?>

<!DOCTYPE html>
<html lang="en">
@include('master.header')


<body>

    <div id="all">
    @include('master.navigation')

        <div class='container-fluid '>

          <div class="row">

            <!-- @include('master.sidebar') -->


            <div class="col-xs-12 col-sm-9 col-md-10">

                @if(Session::get('type')=='teacher'):
                    @include('master.teacherEvents')
                @else:
                    @include('master.studentEvents')
                @endif


            </div>
          </div>

        </div>



    </div>
    <!-- /#all -->

        @include('master.js')

    <script>
    $('.event-intro').enscroll({
      showOnHover: true,
      verticalTrackClass: 'track',
      verticalHandleClass: 'handle'
    });
    </script>


</body>

</html>

