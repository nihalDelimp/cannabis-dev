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
    <form method="post" action="{{ route('truck.store',app()->getLocale()) }}" enctype="multipart/form-data" class="form">
    @csrf
    <div class="form-group col-sm-6">
    <label for="title">{{langMessage('truck title')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="title" value="{{ old('title') }}" type="text" id="title" placeholder="{{langMessage('truck title')}}" required>
    @error('title')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="truck_number">{{langMessage('truck number')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="truck_number" value="{{ old('truck_number') }}" type="text" id="truck_number" placeholder="{{langMessage('truck number')}}" required>
    @error('truck_number')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="service_location">{{langMessage('service location')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="service_location" id="service_location" required>
      <option value="">{{'select'}}</option>
      @if(!$locations->isEmpty())
        @foreach($locations as $location)
          <option value="{{$location->id}}" {{ old('service_location') == $location->id ? 'selected' : '' }}>{{$location->location_name}}</option>
        @endforeach
      @endif
    </select>
    @error('status')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
    <label for="service_type">{{langMessage('Service type')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="service_type" id="service_type" required>
      <option value="">{{langMessage('select')}}</option>
      @if(!$locations->isEmpty())
        @foreach($services as $service)
          <option value="{{$service->id}}"  {{ old('service_type') == $service->id ? 'selected' : '' }}>{{$service->service_name}}</option>
        @endforeach
      @endif
    </select>
    @error('service_id')
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
