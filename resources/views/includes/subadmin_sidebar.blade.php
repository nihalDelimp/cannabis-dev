<section class="sidebar">
  <ul class="sidebar-menu" data-widget="tree">
    <!-- <li class="header">@lang('main navigation')</li> -->
    <li class="{{ $controller == 'DashboardController'?'active':''}}"><a href="{{ route('dashboard',app()->getLocale()) }}"><i class="fa fa-tachometer"></i> <span>{{langMessage('dashboard')}}</span></a></li>
    <li class="treeview {{ $controller == 'CompanyController'?'active menu-open':''}}">
    <a href="#">
    <i class="fa fa-table"></i> <span>{{langMessage('company')}}</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
    <li class="{{ $action == 'create'?'active':'' }}"><a href="{{ route('company_user.create',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('add')}}</a></li>
    <li  class="{{ $action == 'index'?'active':'' }}"><a href="{{ route('company_user.index',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('manage')}}</a></li>
    </ul>
    </li>
    <li class="treeview {{ $controller == 'TruckController'?'active menu-open':''}}">
    <a href="#">
    <i class="fa fa-table"></i> <span>{{langMessage('trucks')}}</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
    <li class="{{ $action == 'create'?'active':'' }}"><a href="{{ route('truck.create',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('add')}}</a></li>
    <li  class="{{ $action == 'index'?'active':'' }}"><a href="{{ route('truck.index',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('manage')}}</a></li>
    </ul>
    </li>
    <li class="treeview {{ $controller == 'JobController'?'active menu-open':''}}">
    <a href="#">
    <i class="fa fa-table"></i> <span>{{langMessage('job')}}</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
    <li class="{{ $action == 'create'?'active':'' }}"><a href="{{ route('job.create',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('add')}}</a></li>
    <li  class="{{ $action == 'index'?'active':'' }}"><a href="{{ route('job.index',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('manage')}}</a></li>
    </ul>
    </li>
  </ul>
</section>
