@extends('layouts.default')
@section('content')
  <section class="content-header">
    <h1>
      @lang('dashboard')
      <small>@lang(strtolower($pageHeading))</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> @lang('dashboard')</a></li>
      <li class="active">@lang(strtolower($pageHeading))</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">@lang(strtolower($pageHeading))</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">

            </div>
            <div class="row">
              <div class="col-xs-12 text-center">
              <h2>@lang('welcome') {{ Auth::user()->name }}</h2>
              </div>
            </div>
            @if(Auth::user()->role == 1)
            <div class="row">
              <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>{{85 }}</h3>
                  <p>@lang(strtolower('one'))</p>
                </div>
                <div class="icon">
                  <i class="fa fa-home" aria-hidden="true"></i>
                </div>
                <a target="_blank" href="" class="small-box-footer">@lang(strtolower('More info')) <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{25 }}</h3>
                  <p>@lang(strtolower('two'))</p>
                </div>
                <div class="icon">
                  <i class="fa fa-truck" aria-hidden="true"></i>
                </div>
                <a href="#" class="small-box-footer">@lang(strtolower('More info')) <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{7}}</h3>
                  <p>@lang(strtolower('three'))</p>
                </div>
                <div class="icon">
                  <i class="fa fa-home" aria-hidden="true"></i>
                </div>
                <a href="#" class="small-box-footer">@lang(strtolower('More info')) <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{4}}</h3>
                  <p>@lang(strtolower('four'))</p>
                </div>
                <div class="icon">
                  <i class="fa fa-truck" aria-hidden="true"></i>
                </div>
                <a href="#" class="small-box-footer">@lang(strtolower('More info')) <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3>{{9}}</h3>
                  <p>@lang(strtolower('five'))</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-circle" aria-hidden="true"></i>
                </div>
                <a href="#" class="small-box-footer">@lang(strtolower('More info')) <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{20 }}</h3>
                  <p>@lang(strtolower('six'))</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-circle" aria-hidden="true"></i>
                </div>
                <a href="#" class="small-box-footer">@lang(strtolower('More info')) <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            </div>
            @endif
              </div>
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
