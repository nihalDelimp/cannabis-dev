@extends('layouts.default')
@section('content')
  <section class="content-header">
    <h1>
      @lang('dashboard')
      <small>@lang($pageHeading)</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> @lang('dashboard')</a></li>
      <li class="active">@lang($pageHeading)</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">@lang($pageHeading)</h3>
            <a href="{{ route('transporter_driver.index',app()->getLocale() ) }}" class="btn btn-success pull-right">@lang('back')</a>
          </div>
          <!-- /.box-header -->
    <div class="box-body">
      @if($message = Session::get('success'))
      <div class="alert alert-success">
        <p>@lang($message)</p>
      </div>
      @endif
      @if($driver)
        <table class="table table-bordered table-hover mb-10" role="grid">
          <tr>
            <th>@lang('name')</th><td>{{ $driver->name }}</td>
            <th>@lang('email')</th><td>{{ $driver->email }}</td>
          </tr>
          <tr>
            <th>@lang('phone')</th><td>{{ $driver->phone }}</td>
            <th>@lang('joining date')</th><td>{{ getDateTime($driver->created_at, 'd F Y') }}</td>
          </tr>
        </table>
      @endif
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
@section('pagejs')

@stop
