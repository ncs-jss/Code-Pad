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
            // var_dump($flight->endtime['enddate']);
          ?>

        <div class="event-item col-xs-6 col-md-3">
            <div class="spacer col-xs-12">
                <h2 class="event-heading"><a href="update/{{ $flight->code }}">{{ $flight->name }} </a></h2>

                <p class="event-intro"> <strong> Description: </strong>{{ $flight->description }}</p>
                <p class="read-more text-center "><a href="#" class="btn btn-template-main">Participate </a></p>
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
