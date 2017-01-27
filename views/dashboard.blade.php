<?php
if(Auth::guard('admin')->check()):
    $result = Auth::guard('admin')->user();
elseif(Auth::guard('student')->check()):
    $result = Auth::guard('student')->user();
else:
    $result = Auth::guard('teacher')->user();
endif;
// echo $message;
?>
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
            <div class="item">
              <div class="row">
                <div class="col-sm-7">
                  <img class="img-responsive" src="{{URL::asset('public/assets/img/template-easy-code.png')}}" alt="">
                </div>
                <div class="col-sm-5">
                  <center>
                    <h1>
                      CODE <br>
                      COMPETE <br>
                      COLLABORATE
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
            <div class="item">
              <div class="row">
                <div class="col-sm-7">
                  <img class="img-responsive" src="{{URL::asset('public/assets/img/template-easy-code.png')}}" alt="">
                </div>
                <div class="col-sm-5">
                  <center>
                    <h1>
                      CODE <br>
                      COMPETE <br>
                      COLLABORATE
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
            <div class="col-xs-6 col-sm-3">
              <div class="home box-simple">
                <div class="border">
                  <div class="icon">
                    <i class="fa fa-globe fa-2x"></i>
                  </div>
                </div>
                <h3>Research</h3>
                <p>Fifth abundantly made Give sixth hath. Cattle creature i be don't them behold green moved fowl Moved life us beast good yielding. Have bring.</p>
              </div>
            </div>
            <div class="col-xs-6 col-sm-3">
              <div class="home box-simple">
                <div class="border">
                  <div class="icon">
                      <i class="fa fa-laptop fa-2x"></i>
                  </div>
                </div>
                  <h3>Code</h3>
                    <p>Fifth abundantly made Give sixth hath. Cattle creature i be don't them behold green moved fowl Moved life us beast good yielding. Have bring.</p>
              </div>
            </div>
            <div class="col-xs-6 col-sm-3">
              <div class="home box-simple">
                <div class="border">
                  <div class="icon">
                    <i class="fa fa-comments-o fa-2x"></i>
                  </div>
                </div>
                <h3>Coordinate</h3>
                <p>Fifth abundantly made Give sixth hath. Cattle creature i be don't them behold green moved fowl Moved life us beast good yielding. Have bring.</p>
              </div>
            </div>
            <div class="col-xs-6 col-sm-3">
              <div class="home box-simple">
                <div class="border">
                  <div class="icon">
                    <i class="fa fa-cogs fa-2x"></i>
                  </div>
                </div>
                <h3>Test</h3>
                <p>Fifth abundantly made Give sixth hath. Cattle creature i be don't them behold green moved fowl Moved life us beast good yielding. Have bring.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bar background-white no-mb">
      <div class="container">

          <div class="col-md-12  text-center">
              <div class=" text-center">
                        <h3>Let them know why youre the best!</h3>
                    </div>

                    <p class="lead">Share it. Enjoy It. <span class="accent"> Start Here!</span>
                    </p>


              <div class="row">
                  <div class="col-md-3 col-sm-6">
                      <div class="box-image-text blog">
                          <div class="top">
                              <div class="image">
                                        <img src="{{URL::asset('public/assets/img/portfolio-4.jpg')}}" alt="" class="img-responsive">
                                    </div>
                              <div class="bg"></div>
                              <div class="text">
                                        <p class="buttons">
                                            <a href="blog-post.html" class="btn btn-template-transparent-primary"><i class="fa fa-plus-circle"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-image-text -->

                        </div>
                  <div class="col-md-3 col-sm-6">
                      <div class="box-image-text blog">
                          <div class="top">
                              <div class="image">
                                        <img src="{{URL::asset('public/assets/img/portfolio-4.jpg')}}" alt="" class="img-responsive">
                                    </div>
                              <div class="bg"></div>
                              <div class="text">
                                        <p class="buttons">
                                            <a href="blog-post.html" class="btn btn-template-transparent-primary"><i class="fa fa-plus-circle"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-image-text -->

                        </div>
                  <div class="col-md-3 col-sm-6">
                      <div class="box-image-text blog">
                          <div class="top">
                              <div class="image">
                                        <img src="{{URL::asset('public/assets/img/portfolio-4.jpg')}}" alt="" class="img-responsive">
                                    </div>
                              <div class="bg"></div>
                              <div class="text">
                                        <p class="buttons">
                                            <a href="blog-post.html" class="btn btn-template-transparent-primary"><i class="fa fa-plus-circle"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-image-text -->

                        </div>
                  <div class="col-md-3 col-sm-6">
                      <div class="box-image-text blog">
                          <div class="top">
                              <div class="image">
                                        <img src="{{URL::asset('public/assets/img/portfolio-4.jpg')}}" alt="" class="img-responsive">
                                    </div>
                              <div class="bg"></div>
                              <div class="text">
                                        <p class="buttons">
                                            <a href="blog-post.html" class="btn btn-template-transparent-primary"><i class="fa fa-plus-circle"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-image-text -->

                        </div>


                    </div>
                    <!-- /.row -->

                    <!-- *** BLOG HOMEPAGE END *** -->

                </div>

            </div>
            <!-- /.container -->
        </section>
        <!-- /.bar -->

          <section class="no-mb">
      <div class='container-fluid team-wrapper'>
        <div class="row">
            <div class="col-xs-6 col-sm-3">
                <div class="team-member" data-animate="fadeInDown">
                    <div class="image">
                              <a href="team-member.html">
                                  <img src="{{URL::asset('public/assets/img/person.jpg')}}" alt="" class="img-responsive img-circle">
                              </a>
                          </div>
                          <h3><a href="team-member.html">Team Member</a></h3>
                          <p class="role">Founder</p>
                      </div>
                      <!-- /.team-member -->
                  </div>
            <div class="col-xs-6 col-sm-3" data-animate="fadeInDown">
                <div class="team-member">
                    <div class="image">
                              <a href="team-member.html">
                                  <img src="{{URL::asset('public/assets/img/person.jpg')}}" alt="" class="img-responsive img-circle">
                              </a>
                          </div>
                          <h3><a href="team-member.html">Team Member</a></h3>
                          <p class="role">CTO</p>
                      </div>
                      <!-- /.team-member -->
                  </div>
            <div class="col-xs-6 col-sm-3" data-animate="fadeInDown">
                <div class="team-member">
                    <div class="image">
                              <a href="team-member.html">
                                  <img src="{{URL::asset('public/assets/img/person.jpg')}}" alt="" class="img-responsive img-circle">
                              </a>
                          </div>
                          <h3><a href="team-member.html">Team Member</a></h3>
                          <p class="role">Team Leader</p>
                      </div>
                      <!-- /.team-member -->
                  </div>
            <div class="col-xs-6 col-sm-3" data-animate="fadeInDown">
                <div class="team-member">
                    <div class="image">
                              <a href="team-member.html">
                                  <img src="{{URL::asset('public/assets/img/person.jpg')}}" alt="" class="img-responsive img-circle">
                              </a>
                          </div>
                          <h3><a href="team-member.html">Team Member</a></h3>
                          <p class="role">Lead Developer</p>
                      </div>
                      <!-- /.team-member -->
                  </div>
              </div>
              <!-- /.row -->
            </div>
          </section>

          <section class="home bar no-mb color-white">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                  <div class="embed-responsive embed-responsive-16by9">
                          <iframe src="https://www.youtube.com/embed/rwy50QEpAsA"> </iframe>
                        </div>
                      </div>
                <div class="col-xs-12 col-sm-6">
                          <h2>What Are You Waiting For?</h2>
                          <h2>Start It Today!</h2>

                          <p class="lead">
                            Explore the best in you, coz the time has arrivedto lift up yourselfat the epitome of ambitions. <br>
                            Happy Coding! <br><br>
                            <button type="button" class="btn btn-template-transparent-primary">Find Out More</button>
                          </p>

                      </div>
                  </div>
              </div>
          </section>

          <section class="no-mb color-white">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                        <h2>EXTRAS</h2>

                        <p class="lead">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta ex accusamus qui ipsa nisi eligendi aliquam omnis voluptatem veniam vero deserunt amet, incidunt harum debitis ullam ratione necessitatibus dignissimos minus.
                        </p>
                      </div>
                <div class="col-sm-8">

                          <h2>Events</h2>

                    <div class="photostream">
                      <div class="row">
                        <div class="col-xs-3 col-sm-3">
                                  <a href="#">
                                    <img src="{{URL::asset('public/assets/img/detailsquare.jpg')}}" class="img-responsive" alt="#">

                                  </a>
                              </div>
                        <div  class="col-xs-3 col-sm-3">
                                  <a href="#">
                                      <img src="{{URL::asset('public/assets/img/detailsquare.jpg')}}" class="img-responsive" alt="#">
                                  </a>
                              </div>
                        <div  class="col-xs-3 col-sm-3">
                                  <a href="#">
                                      <img src="{{URL::asset('public/assets/img/detailsquare.jpg')}}" class="img-responsive" alt="#">
                                  </a>
                              </div>
                        <div class="col-xs-3 col-sm-3">
                                  <a href="#">
                                      <img src="{{URL::asset('public/assets/img/detailsquare.jpg')}}" class="img-responsive" alt="#">
                                  </a>
                              </div>

                            </div>
                          </div>

                      </div>
                      <!-- /.col-md-3 -->
                  </div>
              </div>
          </section>
  @endsection
  @section('footer')
    @include('master.footer')
  @endsection
