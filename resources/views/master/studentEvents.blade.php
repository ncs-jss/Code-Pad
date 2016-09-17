<section>
  <div class="events-wrap container-fluid">
        <div class="heading col-sm-12 text-center">
            <h3> On Going Events: </h3>
        </div>

        <!-- Events Listing Start Here -->
          <?php
          foreach($programList as $flight)
          {
            $flight['starttime']=unserialize($flight['starttime']);
            $flight['endtime']=unserialize($flight['endtime']);
              // echo '<a href=update/'.$flight->code.'>'.$flight->name.'</a><br>';
            date_default_timezone_set('Asia/Kolkata');
            $time = date("YmdHi",time());
          ?>

        <div class="event-item col-xs-12 col-sm-6 col-md-3">
            <div class="spacer col-xs-12">
                <h2 class="event-heading"><a href="contest/{{ $flight->code }}">{{ $flight->name }} </a></h2>

                <p><div class="event-intro"> <strong> Description: </strong>{!!$flight->description!!}</div></p>
                <p class="read-more text-center "><a href="contest/{{ $flight->code }}" class="btn btn-template-main">Participate </a></p>
                <div class="clearfix">
                    <p class="pull-left">By <a href="#">{{ $flight->uploaded_by }}</a></p>
                    <p class="pull-right"><i class="fa fa-calendar-o"></i>{{ $flight->starttime['startdate'] }}</p>
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
