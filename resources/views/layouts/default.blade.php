<!DOCTYPE html>
<html>
<head>
  @include('includes.head')
  @yield('pagecss')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    @if(in_array(Auth::user()->role,[1,2]))
      @include('includes.header')
    @elseif(in_array(Auth::user()->role,[3,4]))
      @include('includes.header')
    @else
      @include('includes.buyer.header')
    @endif

  </header>
  <aside class="main-sidebar">
    @if(in_array(Auth::user()->role,[1]))
      @include('includes.sidebar')
    @elseif(in_array(Auth::user()->role,[2]))
      @include('includes.subadmin_sidebar')
    @elseif(in_array(Auth::user()->role,[3]))
      @include('includes.companyadmin_sidebar')
    @elseif(in_array(Auth::user()->role,[4]))
      @include('includes.salesrep_sidebar')
    @else
      @include('includes.buyer.sidebar')
    @endif
  </aside>
<div class="content-wrapper">
  @yield('content')
</div>
  @include('includes.footer')
  @yield('pagejs')
</body>
</html>
