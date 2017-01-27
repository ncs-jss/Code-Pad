<?php
  $previous =[];
?>
<section>
  <div class="col-sm-12 text-center">
      <h3> On Going Events: </h3>
  </div>
  <div class="events-wrap container-fluid">


        <!-- Events Listing Start Here -->
          <?php
          foreach($programList as $flight)
          {
            date_default_timezone_set('Asia/Kolkata');
            $time = date("YmdHi",time());
            if($flight['end']<$time)
              $previous = array_merge($previous, [$flight]);
            else
            {
              $flight['starttime']=unserialize($flight['starttime']);
              $flight['endtime']=unserialize($flight['endtime']);
              // echo '<a href=update/'.$flight->code.'>'.$flight->name.'</a><br>';

            ?>
        <div class="event-item col-sm-6 col-xs-12 col-md-3">
            <div class="spacer col-xs-12">
                <h2 class="event-heading"><a href="events/{{ $flight->code }}">{{ $flight->name }} </a></h2>

                <p><strong> Description: </strong><div class="event-intro"> {!!$flight->description!!}</div></p>
                <p class="text-center">
                    <strong> <span class="fa fa-clock-o"></span> {{$flight['starttime']['starttime']." - ".$flight['endtime']['endtime']}} </strong>
                </p>
                <p class="read-more text-center">
                  <a href="events/{{ $flight->code }}" class="btn">Review </a>
                </p>
                <div class="clearfix">
                    <p class="pull-left">By <a href="#">{{ $flight->uploaded_by }}</a></p>
                    <p class="pull-right"><i class="fa fa-calendar-o"></i> {{ $flight->starttime['startdate'] }}</p>
                </div>
            </div>
        </div>
        <!-- event item end -->
        <?php
      }
    }
      ?>


  </div>
  <div class="col-sm-12 text-center">
      <h3> Previous Events: </h3>
  </div>
  <div class="events-wrap container-fluid">


        <!-- Events Listing Start Here -->
          <?php
          foreach($previous as $pre)
          {
            // $pre = json_decode(json_encode($pre), true);
            $pre['starttime']=unserialize($pre['starttime']);
            $pre['endtime']=unserialize($pre['endtime']);
              // echo '<a href=update/'.$pre->code.'>'.$pre->name.'</a><br>';
            date_default_timezone_set('Asia/Kolkata');
            $time = date("YmdHi",time());
          ?>
        <div class="event-item col-sm-6 col-xs-12 col-md-3">
            <div class="spacer col-xs-12">
                <h2 class="event-heading"><a href="events/{{ $pre->code }}">{{ $pre->name }} </a></h2>

                <p><strong> Description: </strong><div class="event-intro"> {!!$pre->description!!}</div></p>
                <p class="text-center">
                    <strong> <span class="fa fa-clock-o"></span> {{$pre['starttime']['starttime']." - ".$pre['endtime']['endtime']}} </strong>
                </p>
                <p class="read-more text-center">
                  <a href="events/{{ $pre->code }}" class="btn">Review </a>
                </p>
                <div class="clearfix">
                    <p class="pull-left">By <a href="#">{{ $pre->uploaded_by }}</a></p>
                    <p class="pull-right"><i class="fa fa-calendar-o"></i> {{ $pre->starttime['startdate'] }}</p>
                </div>
            </div>
        </div>
        <!-- event item end -->
        <?php
    }
      ?>


  </div>
  <!-- events wrap end -->
</section>
