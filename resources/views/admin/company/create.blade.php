@extends('layouts.default')
@section('content')
  <section class="content-header">
    <h1>
      {{langMessage('dashboard')}}
      <small>{{langMessage(strtolower($pageHeading))}}</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> {{langMessage('dashboard')}}</a></li>
      <li class="active">{{langMessage(strtolower($pageHeading))}}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{langMessage(strtolower($pageHeading))}}</h3>
          </div>
          <!-- /.box-header -->
    <div class="box-body">
      @if($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{langMessage(strtolower($message))}}</p>
      </div>
      @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{langMessage(strtolower($error))}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="post" action="{{ route('company_user.store',app()->getLocale()) }}" enctype="multipart/form-data" class="form">
    @csrf
    <div class="form-group col-sm-6">
    <label for="Name">{{langMessage('company name')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="company_name" value="{{ old('company_name') }}" type="text" id="first_name" placeholder="{{langMessage('company name')}}" required>
    @error('company_name')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="status">{{langMessage('status')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="status" id="status" required>
      <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{langMessage('active')}}</option>
      <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{langMessage('in active')}}</option>
    </select>
    @error('status')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="Name">{{langMessage('representative first name')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="first_name" value="{{ old('first_name') }}" type="text" id="first_name" placeholder="{{langMessage('representative first name')}}" required>
    @error('first_name')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="Name">{{langMessage('representative last name')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="last_name" value="{{ old('last_name') }}" type="text" id="last_name" placeholder="{{langMessage('representative last name')}}" required>
    @error('last_name')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="Email">{{langMessage('email address')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="email" value="{{ old('email') }}" type="text" id="Email" placeholder="{{langMessage('email address')}}" required>
    @error('email')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="Auth_Id">{{langMessage('phone number')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <div class="input-group">
    <span class="input-group-addon">+1</span>
    <input class="form-control" name="phone" value="{{ old('phone') }}" type="text" id="Auth_Id" placeholder="{{langMessage('phone number')}}" required>
    </div>
    @error('phone')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="address1">{{langMessage('address line 1')}}</label>
    <input class="form-control" name="address1" value="{{ old('address1') }}" type="text" id="address1" placeholder="{{langMessage('Street address, P.O.Box, company name, c/0')}}">
    @error('address1')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="address2">{{langMessage('address line 2')}}</label>
    <input class="form-control" name="address2" value="{{ old('address2') }}" type="text" id="address2" placeholder="{{langMessage('Apartment, Suite unit, building, floor,etc')}}">
    @error('address2')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-4">
    <label for="city">{{langMessage('City')}}</label>
    <input class="form-control" name="city" value="{{ old('city') }}" type="text" id="city" placeholder="{{langMessage('City')}}">
    @error('city')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-4">
    <label for="state">{{langMessage('State/Province')}}</label>
    <input class="form-control" name="state" value="{{ old('state') }}" type="text" id="state" placeholder="{{langMessage('State/Province')}}">
    @error('state')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-4">
    <label for="zip_code">{{langMessage('Zip Code')}}</label>
    <input class="form-control" name="zip_code" value="{{ old('zip_code') }}" type="text" id="zip_code" placeholder="{{langMessage('Zip Code')}}">
    @error('zip_code')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="Auth_Id">{{langMessage('password')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="password"  value="{{ old('password') }}" type="text" id="Password" placeholder="{{langMessage('password')}}" required>
    @error('password')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="Confirm_Password">{{langMessage('password confirmation')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="password_confirmation"   value="{{ old('password_confirmation') }}" type="text" id="Confirm_Password" placeholder="{{langMessage('confirm password')}}" required>
    @error('password_confirmation')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-12 text-center">
    <input class="btn btn-primary" name="add" type="submit" value="{{langMessage('add')}}">
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
