@extends('layouts.default')
@section('content')
  <section class="content-header">
    <h1>
      @lang(strtolower('Dashboard'))
      <small>@lang(strtolower('Dashboard'))</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> @lang(strtolower('Home'))</a></li>
      <li><a href="#">@lang(strtolower('Tables'))</a></li>
      <li class="active">@lang(strtolower('Dashboard'))</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">@lang(strtolower('Report'))</h3>
          </div>
          <!-- /.box-header -->
    <div class="box-body">
      <div class="jumbotron text-center">
        <div align="right">
          <a href="{{ route('category.index') }}" class="btn btn-default">>@lang(strtolower('Back'))</a>
        </div>
        <br>
        <h3>Category Name - {{ $category->name }}</h3>
      </div>
    </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
@stop
