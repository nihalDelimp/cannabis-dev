<section class="sidebar">
  <ul class="sidebar-menu" data-widget="tree">
    <!-- <li class="header">@lang('main navigation')</li> -->
    <li class="{{ $controller == 'DashboardController'?'active':''}}"><a href="{{ route('dashboard',app()->getLocale()) }}"><i class="fa fa-tachometer"></i> <span>{{langMessage('dashboard')}}</span></a></li>
    <li class="treeview {{ $controller == 'TemplateController'?'active menu-open':''}}">
    <a href="#">
    <i class="fa fa-table"></i> <span>{{langMessage('email template')}}</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
    <li  class="{{ $action == 'index'?'active':'' }}"><a href="{{ route('template.index',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('manage email template')}}</a></li>
    </ul>
    </li>
    <li class="treeview {{ $controller == 'CategoryController'?'active menu-open':''}}">
    <a href="#">
    <i class="fa fa-table"></i> <span>{{langMessage('Category')}}</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
    <li class="{{ $action == 'create'?'active':'' }}"><a href="{{ route('category.create',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('add')}}</a></li>
    <li  class="{{ $action == 'index'?'active':'' }}"><a href="{{ route('category.index',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('manage')}}</a></li>
    </ul>
    </li>
    <li class="treeview {{ $controller == 'TagController'?'active menu-open':''}}">
    <a href="#">
    <i class="fa fa-table"></i> <span>{{langMessage('Tag')}}</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
    <li class="{{ $action == 'create'?'active':'' }}"><a href="{{ route('tag.create',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('add')}}</a></li>
    <li  class="{{ $action == 'index'?'active':'' }}"><a href="{{ route('tag.index',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('manage')}}</a></li>
    </ul>
    </li>
    <li class="treeview {{ $controller == 'NewsController'?'active menu-open':''}}">
    <a href="#">
    <i class="fa fa-table"></i> <span>{{langMessage('News')}}</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
    <li class="{{ $action == 'create'?'active':'' }}"><a href="{{ route('news.create',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('add')}}</a></li>
    <li  class="{{ $action == 'index'?'active':'' }}"><a href="{{ route('news.index',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('manage')}}</a></li>
    </ul>
    </li>
    <li class="treeview {{ in_array($controller,['VideoController','PlayListController']) ?'active menu-open':''}}">
    <a href="#">
    <i class="fa fa-table"></i> <span>{{langMessage('Videos')}}</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
    <li class="{{ $action == 'create'?'active':'' }}"><a href="{{ route('video.create',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('add')}}</a></li>
    <li  class="{{ $action == 'index'?'active':'' }}"><a href="{{ route('video.index',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> {{langMessage('manage')}}</a></li>
    <li class="{{ $action == 'playListIndex'?'active':''}}"><a href="{{ route('admin.play.list',app()->getLocale()) }}"><i class="fa fa-circle-o"></i> <span>{{langMessage('Playlist')}}</span></a></li>
    </ul>
    </li>
  </ul>
</section>
