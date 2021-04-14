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
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>@lang(strtolower($error))</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div align="right">
            <a href="{{ route('dashboard',app()->getLocale()) }}" class="btn btn-success">@lang(strtolower('Back'))</a>
          </div>
          @if($message = Session::get('success'))
            <div class="alert alert-success">
              <p>@lang(strtolower($message))</p>
            </div>
          @endif
          <form method="post" action="{{ route('dashboard.updateprofile',app()->getLocale()) }}" enctype="multipart/form-data" class="form">
            @csrf
            @method('POST')
          <div class="form-group col-sm-6">
          <label for="Name">@lang(strtolower('Name'))</label>
          <input class="form-control" value="{{ $employee->name }}" name="name" type="text" id="Name" placeholder="@lang(strtolower('Employee Name'))">
          </div>
          <div class="form-group col-sm-6">
          <label for="Email">@lang(strtolower('Email'))</label>
          <input class="form-control" name="email" value="{{ $employee->email }}" disabled type="text" id="Email" placeholder="@lang(strtolower('Employee Email'))">
          </div>
          <div class="form-group col-sm-6">
          <label for="Auth_Id">@lang(strtolower('Password'))</label>
          <input class="form-control" name="password" type="text" id="Password" placeholder="@lang(strtolower('Password'))">
          </div>
          <div class="form-group col-sm-6">
          <label for="Confirm_Password">@lang(strtolower('Password Confirmation'))</label>
          <input class="form-control" name="password_confirmation" type="text" id="Confirm_Password" placeholder="@lang(strtolower('Confirm Password'))">
          </div>
          <!-- <div class="form-group col-sm-6">
          <label for="Contact_Number">Contact Number</label>
          <input class="form-control" value="{{ $employee->contact_number }}" name="contact_number" type="text" id="Contact_Number" placeholder="Contact Number" disabled>
          </div>
          <div class="form-group col-sm-6">
          <label for="Emergency_Contact_Number">Emergency Contact Number</label>
          <input class="form-control" value="{{ $employee->emergency_contact_number }}" name="emergency_contact_number" type="text" id="Emergency_Contact_Number" placeholder="Emergency Contact Number" disabled>
          </div> -->
          <div class="form-group col-sm-12 text-center">
          <input class="btn btn-primary" name="add" type="submit" value="@lang(strtolower('Update'))">
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
 $('#Date_of_Birth, #Joining_Date, #Anniversary_Date').datepicker({
    autoclose: true
  });
</script>
@stop
