<!DOCTYPE html>
<html lang="en">

<head>
    @include('master.header')
    @yield('head')
</head>

<body>
  @yield('body')
  @include('master.navigation')

  <div id="all" style="margin-top:62px;">
    @yield('content')
  </div>

  @yield('footer')
  @include('master.js')
  @yield('script')

</body>

</html>
