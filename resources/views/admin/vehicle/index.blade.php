@extends('layouts.default')
@section('content')
  <section class="content-header">
    <h1>
      @lang('dashboard')
      <small>@lang(strtolower($pageHeading))</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> @lang('home')</a></li>
      <li><a href="#">@lang('dashboard')</a></li>
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
      <div align="right">
        <a href="{{ route('vehicle.create',app()->getLocale()) }}" class="btn btn-success">@lang(strtolower('Add'))</a>
      </div>
      @if($message = Session::get('success'))
      <div class="alert alert-success">
        <p>@lang(strtolower($message))</p>
      </div>
      @endif
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>@lang('sn')</th><th>@lang('name')</th><th>@lang('action')</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $key=>$category)
          <tr>
            <td scope="row">{{ $categories->firstItem()+$key }}</td><td>{{ langMessage($category->name) }}</td>
            <td>
              <a class="btn btn-warning" href="{{ route('vehicle.edit', ['id' => $category->id, 'locale' => app()->getLocale()]) }}">@lang('edit')</a>
              <form style="display:inline-block;" action="{{ route('vehicle.destroy', ['id' => $category->id, 'locale' => app()->getLocale()]) }}" method="post">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('<?php echo langMessage('Are you sure?');?>')" type="submit" class="btn btn-danger">@lang('delete')</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {!! $categories->links() !!}
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
