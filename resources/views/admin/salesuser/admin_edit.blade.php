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
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>@lang(strtolower($error))</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="post" action="{{ route('sales_user.update', ['id'=>$user->id,'locale'=>app()->getLocale()]) }}" enctype="multipart/form-data" class="form">
      @csrf
      @method('PATCH')
      <div class="form-group col-sm-6">
      <label for="Name">@lang('first name')<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
      <input class="form-control" name="first_name" value="{{ $user->first_name }}" type="text" id="first_name" placeholder="@lang('first name')" required>
      </div>
      <div class="form-group col-sm-6">
      <label for="Name">@lang('last name')<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
      <input class="form-control" name="last_name" value="{{ $user->last_name }}" type="text" id="last_name" placeholder="@lang('last name')" required>
      </div>
    <div class="form-group col-sm-6">
    <label for="Email">@lang('email address')<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="email" value="{{ $user->email }}" type="text" id="Email" placeholder="@lang('email address')" required>
    </div>
    <div class="form-group col-sm-6">
    <label for="Auth_Id">@lang('phone number')<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <div class="input-group">
    <span class="input-group-addon">+1</span>
    <input class="form-control" name="phone" value="{{ $user->phone }}" type="text" id="Auth_Id" placeholder="@lang('phone number')" required>
    </div>
    </div>
    <div class="form-group col-sm-6">
    <label for="Auth_Id">@lang('password')</label>
    <input class="form-control" name="password"  value="" type="text" id="Password" placeholder="@lang('password')">
    </div>
    <div class="form-group col-sm-6">
    <label for="Confirm_Password">@lang('password confirmation')</label>
    <input class="form-control" name="password_confirmation"   value="" type="text" id="Confirm_Password" placeholder="@lang('confirm password')">
    </div>
    <div class="form-group col-sm-6">
    <label for="company_id">{{langMessage('company')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="company_id" id="company_id" required>
      <option value="">{{'select'}}</option>
      @if(!$companies->isEmpty())
        @foreach($companies as $company)
          <option value="{{$company->id}}" @if($user->company_id == $company->id) {{ 'selected' }} @endif>{{$company->company_name}}</option>
        @endforeach
      @endif
    </select>
    </div>
    <div class="form-group col-sm-6">
    <label for="status">@lang('status')<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="status" id="status" required>
      <option value="1"  @if($user->status == 1) {{ 'selected' }} @endif>@lang('active')</option>
      <option value="0"  @if($user->status == 0) {{ 'selected' }} @endif>@lang('in active')</option>
    </select>
    </div>
    <div class="form-group col-sm-12 text-center">
    <input class="btn btn-primary" name="add" type="submit" value="@lang('update')">
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
