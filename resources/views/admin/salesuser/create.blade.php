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
      @if($message = Session::get('success'))
      <div class="alert alert-success">
        <p>@lang(strtolower($message))</p>
      </div>
      @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>@lang(strtolower($error))</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="post" action="{{ route('sales_user.store',app()->getLocale()) }}" enctype="multipart/form-data" class="form">
    @csrf
    <div class="form-group col-sm-6">
    <label for="Name">@lang('first name')<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="first_name" value="{{ old('first_name') }}" type="text" id="first_name" placeholder="@lang('first name')" required>
    @error('first_name')
        <span class="text-danger" role="alert">
            <strong>@lang(strtolower($message))</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="Name">@lang('last name')<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="last_name" value="{{ old('last_name') }}" type="text" id="last_name" placeholder="@lang('last name')" required>
    @error('last_name')
        <span class="text-danger" role="alert">
            <strong>@lang(strtolower($message))</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="Email">@lang('email address')<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="email" value="{{ old('email') }}" type="text" id="Email" placeholder="@lang('email address')" required>
    @error('email')
        <span class="text-danger" role="alert">
            <strong>@lang(strtolower($message))</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="Auth_Id">@lang('phone number')<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <div class="input-group">
      <span class="input-group-addon">+1</span>
      <input class="form-control" name="phone" value="{{ old('phone') }}" type="text" id="Auth_Id" placeholder="@lang('phone number')" required>
    </div>
    @error('phone')
        <span class="text-danger" role="alert">
            <strong>@lang(strtolower($message))</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="Auth_Id">@lang('password')<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="password"  value="{{ old('password') }}" type="text" id="Password" placeholder="@lang('password')" required>
    @error('password')
        <span class="text-danger" role="alert">
            <strong>@lang(strtolower($message))</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="Confirm_Password">@lang('password confirmation')<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="password_confirmation"   value="{{ old('password_confirmation') }}" type="text" id="Confirm_Password" placeholder="@lang('confirm password')" required>
    @error('password_confirmation')
        <span class="text-danger" role="alert">
            <strong>@lang(strtolower($message))</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="status">@lang('status')<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="status" id="status" required>
      <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>@lang('active')</option>
      <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>@lang('in active')</option>
    </select>
    @error('status')
        <span class="text-danger" role="alert">
            <strong>@lang(strtolower($message))</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-12 text-center">
    <input class="btn btn-primary" name="add" type="submit" value="@lang('add')">
    </div>
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
@section('pagejs')
<script>
// $('#warehouse_query').click(function(){
//  if($(this).is(':checked')) {
//   $('.warehouse_location').prop('checked', true);
//  }
//  else {
//   $('.warehouse_location').prop('checked', false);
//  }
// });
</script>
@stop
