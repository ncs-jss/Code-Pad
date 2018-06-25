@php
if(Auth::guard('admin')->check()):
    $result = Auth::guard('admin')->user();
elseif(Auth::guard('student')->check()):
    $result = Auth::guard('student')->user();
else:
    $result = Auth::guard('teacher')->user();
endif;
// echo $message;
@endphp
@extends('layouts.layout')
  @section('body')
    <div class="custom-flash {{ Session::get('class') }} ">{{ Session::get('message') }}</div>
  @endsection
  @section('content')
    <section class="no-mb">
      <!-- *** HOMEPAGE CAROUSEL *** -->
      <div class="home-carousel">

        <div class="dark-mask"></div>

        <div class="container">
          <div class="homepage owl-carousel">
            <div class="item">
              <div class="row">
                <div class="col-sm-7">
                  <img class="img-responsive" src="{{URL::asset('public/assets/img/template-easy-code.png')}}" alt="">
                </div>
                <div class="col-sm-5">
                  <center>
                    <h1>
                      CODE. <br>
                      COMPETE. <br>
                      COLLABORATE.
                    </h1>
                    <ul class="list-style-none">
                      <li>Code Battles</li>
                      <li>Submit Assignments</li>
                      <li>All in one place</li>
                    </ul>
                  </center>
                </div>
              </div>
            </div>
          </div>
        <!-- /.project owl-slider -->
        </div>
      </div>
     <!-- *** HOMEPAGE CAROUSEL END *** -->
    </section>
    <section class="home bar color-white text-center">
      <div class="dark-mask"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1> &lt;&#47;i&gt;  Can Code</h1>
            <p class="lead"></p>
          </div>
        </div>
      </div>
    </section>

    <section class="bar background-white">
      <div class="container">
        <div class="col-md-12">
          <div class="row">
            <div class="col-xs-6 col-sm-4">
              <div class="home box-simple">
                <div class="border">
                  <div class="icon">
                      <i class="fa fa-laptop fa-2x"></i>
                  </div>
                </div>
                  <h3>Code</h3>
                    <p>Solve the problem by coding in your favourite programming language</p>
              </div>
            </div>
            <div class="col-xs-6 col-sm-4">
              <div class="home box-simple">
                <div class="border">
                  <div class="icon">
                    <i class="fa fa-cogs fa-2x"></i>
                  </div>
                </div>
                <h3>Test</h3>
                <p>Our system will test your code with verious test case with all the possiblities.</p>
              </div>
            </div>
            <div class="col-xs-6 col-sm-4">
              <div class="home box-simple">
                <div class="border">
                  <div class="icon">
                    <i class="fa fa-globe fa-2x"></i>
                  </div>
                </div>
                <h3>Compet</h3>
                <p>Try to optimize your code with new algorithms and compete with your friends.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  @endsection
  @section('footer')
    @include('master.footer')
  @endsection
