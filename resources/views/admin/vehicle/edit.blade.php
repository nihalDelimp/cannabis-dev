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
    @if ($errors->any())
      <div align="right">
        <a href="{{ route('vehicle.index') }}" class="btn btn-default">@lang('back')</a>
      </div>
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>@lang($error)</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if($message = Session::get('success'))
    <div class="alert alert-success">
      <p>@lang(strtolower($message))</p>
    </div>
    @endif
    <form method="POST" action="{{ route('vehicle.update',['id'=>$category->id,'locale'=>app()->getLocale()]) }}" class="form">
    @csrf
    @method('PATCH')
    <div class="row">
      <div class="form-group col-sm-6">
      <label for="Name">@lang('category name')<i class="fa fa-star text-red" aria-hidden="true"></i></label>
      <input required class="form-control" name="name" value="{{ $category->name }}" type="text" id="Name" placeholder="@lang('category name')" >
      @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>@lang(strtolower($message))</strong>
          </span>
      @enderror
      </div>
      <div class="form-group col-sm-6">
      <label for="status">@lang('status')<i class="fa fa-star text-red" aria-hidden="true"></i></label>
      <select class="form-control" name="status" id="status" required>
        <option value="1" {{ $category->status == '1' ? 'selected' : '' }}>@lang('active')</option>
        <option value="0" {{ $category->status == '0' ? 'selected' : '' }}>@lang('in active')</option>
      </select>
      @error('status')
          <span class="invalid-feedback" role="alert">
              <strong>@lang(strtolower($message))</strong>
          </span>
      @enderror
      </div>
    </div>
    <input class="btn btn-info" type="submit" value="@lang('update')">
    </form>
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
