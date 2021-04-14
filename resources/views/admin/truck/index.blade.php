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
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title">{{langMessage('search')}}</h3>
        </div>
        <div class="box-body">
          <form id="search-form">
          <div class="row">
            <div class="form-group col-sm-3">
            <label for="truck_number">{{langMessage('truck number')}}</label>
            <input class="form-control" name="truck_number" type="text" id="truck_number" placeholder="{{langMessage('truck number')}}">
            </div>
            <div class="form-group col-sm-3">
            <label for="service_location">{{langMessage('service location')}}</label>
            <select class="form-control" name="service_location" id="service_location">
              <option value="">{{'select'}}</option>
              @if(!$locations->isEmpty())
                @foreach($locations as $location)
                  <option value="{{$location->id}}">{{$location->location_name}}</option>
                @endforeach
              @endif
            </select>
            </div><div class="form-group col-sm-3">
            <label for="service_type">{{langMessage('service type')}}</label>
            <select class="form-control" name="service_type" id="service_type">
              <option value="">{{'select'}}</option>
              @if(!$locations->isEmpty())
                @foreach($services as $service)
                  <option value="{{$service->id}}">{{$service->service_name}}</option>
                @endforeach
              @endif
            </select>
            </div>
            <div class="form-group col-sm-3">
            <label for="status">{{langMessage('status')}}</label>
            <select class="form-control" name="status" id="status" required>
              <option value="">{{'all'}}</option>
              <option value="1">{{langMessage('active')}}</option>
              <option value="0">{{langMessage('in active')}}</option>
            </select>
            </div>
          </div>
          <!-- <div class="row">
            <div class="form-group col-sm-3">
            <label for="From_Date">From Date</label>
            <input class="form-control" name="from_date" type="text" id="startdate" placeholder="From Date" data-date-format="yyyy-mm-d">
            </div>
            <div class="form-group col-sm-3">
            <label for="To_Date">To Date</label>
            <input class="form-control" name="to_date" type="text" id="enddate" placeholder="To Date" data-date-format="yyyy-mm-d">
            </div>
          </div> -->
          <div class="row text-center">
            <a href="#" class="btn btn-primary" id="search">{{langMessage('search')}}</a>
            <a href="#" class="btn btn-primary" id="reset">{{langMessage('reset')}}</a>
          </div>
        </form>
        </div>
      </div>
      <table id="leads" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>{{langMessage('title')}}</th>
          <th>{{langMessage('truck number')}}</th>
          <th>{{langMessage('service location')}}</th>
          <th>{{langMessage('service type')}}</th>
          <th>{{langMessage('status')}}</th>
          <th>{{langMessage('action')}}</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
          <th>{{langMessage('title')}}</th>
          <th>{{langMessage('truck number')}}</th>
          <th>{{langMessage('service location')}}</th>
          <th>{{langMessage('service type')}}</th>
          <th>{{langMessage('status')}}</th>
          <th>{{langMessage('action')}}</th>
        </tr>
        </tfoot>
      </table>
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
    $(function(){
      var table = $('#leads').DataTable({
          'pageLength':10,
          'lengthChange': false,
          'searching'   : false,
          "processing": true,
          "serverSide": true,
          "order": [[ 5, "desc" ]],
          "ajax":{
                   url: "{{ route('gettrucks',app()->getLocale()) }}",
                   dataType: "json",
                   type: "POST",
                   data:function(data) {
                    data.truck_number = $('#truck_number').val();
                    data.service_location = $('#service_location').val();
                    data.service_type = $('#service_type').val();
                    data.status = $('#status').val();
                  }
                  // ,
                  // success: function(data){
                  //   console.log(data);
                  // }
                 },
          "columns": [
              { "data": "title" },
              { "data": "truck_number" },
              { "data": "service_location" },
              { "data": "service_type" },
              { "data": "status" },
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

      $("#startdate").datepicker({
          todayBtn:  1,
          autoclose: true,
      }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#enddate').datepicker('setStartDate', minDate);
      });

      $("#enddate").datepicker({autoclose: true})
      .on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('#startdate').datepicker('setEndDate', maxDate);
      });
    })
</script>
@stop
