     <header>
            <!-- *** NAVBAR *** -->

            <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

                <div class="navbar navbar-default yamm" role="navigation" id="navbar">

                    <div class="container">
                        <div class="navbar-header">

                            <a class="navbar-brand home" href="">
                                <img src="{{URL::asset('public/assets/img/logo.png')}}" alt="Universal logo" class="hidden-xs hidden-sm">
                                <img src="{{URL::asset('public/assets/img/logo-small.png')}}" alt="Universal logo" class="visible-xs visible-sm"><span class="sr-only">Universal - go to homepage</span>
                            </a>
                            <div class="navbar-buttons">
                                <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                                    <span class="sr-only">Toggle navigation</span>
                                    <i class="fa fa-align-justify"></i>
                                </button>
                            </div>
                        </div>
                        <!--/.navbar-header -->

                        <div class="navbar-collapse collapse" id="navigation">

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="#"> Home </a>
                                </li>
                                <li class="">
                                    <a href="#"> Dashboard </a>
                                </li>
                                <li class="">
                                    <a href="#"> Services </a>
                                </li>
                                <li class="">
                                    <a href="#"> Blog </a>
                                </li>
                                <li class="">
                                    <a href="#"> Contact </a>
                                </li>
                               @if (!Session::get('start'))
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        Login<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/login') }}">Student Login</a></li>
                                    <li><a href="{{ url('/tlogin') }}">Teacher Login</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        Register<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/register') }}">Student Register</a></li>
                                    <li><a href="{{ url('/tregister') }}">Teacher Register</a></li>
                                </ul>
                            </li>
                            @else
                                @if (Session::get('type')=='student')
                                    <li><a href="{{ url('/std_profile') }}">Edit Profile</a></li>
                                @else
                                    <li><a href="{{ url('/program') }}">Upload Programs</a></li>
                                    <li><a href="{{ url('/tea_profile') }}">Edit Profile</a></li>
                                @endif
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ $result->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                    </ul>
                                </li>

                            @endif

                        </div>

                        <!--/.nav-collapse -->
                    </div>
                </div>
                <!-- /#navbar -->
            </div>
            <!-- *** NAVBAR END *** -->
        </header>

