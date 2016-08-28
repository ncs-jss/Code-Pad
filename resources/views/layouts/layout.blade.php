<!DOCTYPE html>
<html lang="en">

<head>
    @include('master.header')
    @yield('head')
</head>

<body>
  @yield('body')
  <div id="all">
    @include('master.navigation')
    @yield('content')
  </div>

  @yield('footer')
  @include('master.js')
  @yield('script')

</body>

</html>
