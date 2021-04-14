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
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{langMessage(strtolower($error))}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if($message = Session::get('success'))
    <div class="alert alert-success">
      <p>@lang(strtolower($message))</p>
    </div>
    @endif
    <form method="post" action="{{ route('company_user.update', ['id'=>$user->id,'locale'=>app()->getLocale()]) }}" enctype="multipart/form-data" class="form">
      @csrf
      @method('PATCH')
      <div class="form-group col-sm-6">
      <label for="Name">{{langMessage('company name')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
      <input class="form-control" name="company_name" value="{{ $user->company_name }}" type="text" id="company_name" placeholder="{{langMessage('company name')}}" required>
      </div>
      <div class="form-group col-sm-6">
      <label for="status">{{langMessage('status')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
      <select class="form-control" name="status" id="status" required>
        <option value="1"  @if($user->status == 1) {{ 'selected' }} @endif>{{langMessage('active')}}</option>
        <option value="0"  @if($user->status == 0) {{ 'selected' }} @endif>{{langMessage('in active')}}</option>
      </select>
      </div>
      <div class="form-group col-sm-6">
      <label for="Name">{{langMessage('first name')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
      <input class="form-control" name="first_name" value="{{ $user->first_name }}" type="text" id="first_name" placeholder="{{langMessage('first name')}}" required>
      </div>
      <div class="form-group col-sm-6">
      <label for="Name">{{langMessage('last name')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
      <input class="form-control" name="last_name" value="{{ $user->last_name }}" type="text" id="last_name" placeholder="{{langMessage('last name')}}" required>
      </div>
    <div class="form-group col-sm-6">
    <label for="Email">{{langMessage('email address')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="email" value="{{ $user->email }}" type="text" id="Email" placeholder="{{langMessage('email address')}}" required>
    </div>
    <div class="form-group col-sm-6">
    <label for="Auth_Id">{{langMessage('phone number')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <div class="input-group">
    <span class="input-group-addon">+1</span>
    <input class="form-control" name="phone" value="{{ $user->phone }}" type="text" id="Auth_Id" placeholder="{{langMessage('phone number')}}" required>
    </div>
    </div>
    <div class="form-group col-sm-6">
    <label for="address1">{{langMessage('address line 1')}}</label>
    <input class="form-control" name="address1" value="{{ $user->address1 }}" type="text" id="address1" placeholder="{{langMessage('Street address, P.O.Box, company name, c/0')}}">
    </div>
    <div class="form-group col-sm-6">
    <label for="address2">{{langMessage('address line 2')}}</label>
    <input class="form-control" name="address2" value="{{ $user->address2 }}" type="text" id="address2" placeholder="{{langMessage('Apartment, Suite unit, building, floor,etc')}}">
    </div>
    <div class="form-group col-sm-4">
    <label for="city">{{langMessage('City')}}</label>
    <input class="form-control" name="city" value="{{ $user->city }}" type="text" id="city" placeholder="{{langMessage('City')}}">
    </div>
    <div class="form-group col-sm-4">
    <label for="state">{{langMessage('State/Province')}}</label>
    <input class="form-control" name="state" value="{{ $user->state }}" type="text" id="state" placeholder="{{langMessage('State/Province')}}">
    </div>
    <div class="form-group col-sm-4">
    <label for="zip_code">{{langMessage('Zip Code')}}</label>
    <input class="form-control" name="zip_code" value="{{ $user->zip_code }}" type="text" id="zip_code" placeholder="{{langMessage('Zip Code')}}">
    </div>
    <div class="form-group col-sm-6">
    <label for="Auth_Id">{{langMessage('password')}}</label>
    <input class="form-control" name="password"  value="" type="text" id="Password" placeholder="{{langMessage('password')}}">
    </div>
    <div class="form-group col-sm-6">
    <label for="Confirm_Password">{{langMessage('password confirmation')}}</label>
    <input class="form-control" name="password_confirmation"   value="" type="text" id="Confirm_Password" placeholder="{{langMessage('confirm password')}}">
    </div>
    <div class="form-group col-sm-12 text-center">
    <input class="btn btn-primary" name="add" type="submit" value="{{langMessage('update')}}">
    </div>
    </form>
    </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{langMessage('Sales Representatives')}}</h3>
          </div>
          <!-- /.box-header -->
    <div class="box-body">
      <table id="salesReps" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>{{langMessage('name')}}</th>
          <th>{{langMessage('email')}}</th>
          <th>{{langMessage('phone')}}</th>
          <th>{{langMessage('action')}}</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
          <th>{{langMessage('name')}}</th>
          <th>{{langMessage('email')}}</th>
          <th>{{langMessage('phone')}}</th>
          <th>{{langMessage('action')}}</th>
        </tr>
        </tfoot>
      </table>
    </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
@stop
@section('pagejs')
<script>
    $(function(){
      var table = $('#salesReps').DataTable({
          'pageLength':10,
          'lengthChange': false,
          'searching'   : false,
          "processing": true,
          "serverSide": true,
          "order": [[ 3, "desc" ]],
          "ajax":{
                   url: "{{ route('getcompanysalesusers',app()->getLocale()) }}",
                   dataType: "json",
                   type: "POST",
                   data:function(data) {
                    // data.name = $('#Name').val();
                    // data.email = $('#Email').val();
                    // data.phone = $('#Phone').val();
                    // data.from_date = $('#startdate').val();
                    // data.to_date = $('#enddate').val();
                     data.company_id = '{{$user->id}}';
                  }
                  // ,
                  // success: function(data){
                  //   console.log(data);
                  // }
                 },
          "columns": [
              { "data": "name" },
              { "data": "email" },
              { "data": "phone" },
              { "data": "options" }
          ]

      });
      $('#search').on('click', function (event) {
        event.preventDefault();
        table.draw();
      });
      $('#reset').on('click', function(event){
        event.preventDefault();
        $("#search-form")[0].reset();
        table.draw();
      });
    })
</script>
@stop
