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
            <label for="search_location">{{langMessage('location')}}</label>
            <select class="form-control" name="search_location" id="search_location">
              <option value="">{{'all'}}</option>
              @if(!$locations->isEmpty())
                @foreach($locations as $location)
                  <option value="{{$location->id}}">{{$location->location_name}}</option>
                @endforeach
              @endif
            </select>
            </div>
            <div class="form-group col-sm-3">
            <label for="search_service">{{langMessage('service')}}</label>
            <select class="form-control" name="search_service" id="search_service">
              <option value="">{{'all'}}</option>
              @if(!$services->isEmpty())
                @foreach($services as $service)
                  <option value="{{$service->id}}">{{$service->service_name}}</option>
                @endforeach
              @endif
            </select>
            </div>
            <div class="form-group col-sm-3">
            <label for="search_company">{{langMessage('company')}}</label>
            <select class="form-control" name="search_company" id="search_company" {{($account->role > 2)?'disabled':''}}>
              <option value="">{{'all'}}</option>
              @if(!$companies->isEmpty())
                @foreach($companies as $company)
                  <option value="{{$company->id}}" @if($account->role == 3 && $account->id == $company->id) {{'selected'}} @elseif($account->role == 4 && $account->company_id == $company->id) {{'selected'}} @endif>{{$company->company_name}}</option>
                @endforeach
              @endif
            </select>
            </div>
            <div class="form-group col-sm-3">
            <label for="search_status">{{langMessage('status')}}</label>
            <select class="form-control" name="search_status" id="search_status" required>
              <option value="">{{'all'}}</option>
              <option value="0">{{langMessage('pending')}}</option>
              <option value="1">{{langMessage('approved')}}</option>
              <option value="2">{{langMessage('cancelled')}}</option>
              <option value="2">{{langMessage('completed')}}</option>
            </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm-6">
            <label for="search_service_address">{{langMessage('Service Address, City, Zip Code, Consumer, Phone')}}</label>
            <input class="form-control" name="search_service_address" type="text" id="search_service_address" placeholder="{{langMessage('Service Address, City, Zip Code, Consumer, Phone')}}">
            </div>
            <div class="form-group col-sm-3">
            <label for="From_Date">From Date</label>
            <input class="form-control" name="from_date" type="text" id="startdate" placeholder="From Date" data-date-format="yyyy-mm-d">
            </div>
            <div class="form-group col-sm-3">
            <label for="To_Date">To Date</label>
            <input class="form-control" name="to_date" type="text" id="enddate" placeholder="To Date" data-date-format="yyyy-mm-d">
            </div>
          </div>
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
          <th>{{langMessage('#id')}}</th>
          <th>{{langMessage('Booking Date')}}</th>
          <th>{{langMessage('location')}}</th>
          <th>{{langMessage('service')}}</th>
          <th>{{langMessage('Sales Rep')}}</th>
          @if(in_array($account->role,[1,2]))
          <th>{{langMessage('Company')}}</th>
          @endif
          <th>{{langMessage('Status')}}</th>
          <th>{{langMessage('action')}}</th>
        </tr>
        </thead>
        <tfoot>
          <tr>
            <th>{{langMessage('#id')}}</th>
            <th>{{langMessage('Booking Date')}}</th>
            <th>{{langMessage('location')}}</th>
            <th>{{langMessage('service')}}</th>
            <th>{{langMessage('Sales Rep')}}</th>
            @if(in_array($account->role,[1,2]))
            <th>{{langMessage('Company')}}</th>
            @endif
            <th>{{langMessage('Status')}}</th>
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
      var order_value = '{{($account->role > 2)?6:7}}';
      if(order_value == 6){
        var columns = [
            { "data": "id" },
            { "data": "booking_date" },
            { "data": "location_id" },
            { "data": "service_id" },
            { "data": "user_id" },
            { "data": "status" },
            { "data": "options" }
        ]
      }
      else{
        var columns = [
            { "data": "id" },
            { "data": "booking_date" },
            { "data": "location_id" },
            { "data": "service_id" },
            { "data": "user_id" },
            { "data": "company_name" },
            { "data": "status" },
            { "data": "options" }
        ]
      }
      console.log(order_value);
      var table = $('#leads').DataTable({
          'pageLength':10,
          'stateSave': true,
          'lengthChange': false,
          'searching'   : false,
          "processing": true,
          "serverSide": true,
          "order": [[ order_value, "desc" ]],
          "ajax":{
                   url: "{{ route('getjobs',app()->getLocale()) }}",
                   dataType: "json",
                   type: "POST",
                   data:function(data) {
                     data.location = $('#search_location').val();
                     data.service = $('#search_service').val();
                     data.company = $('#search_company').val();
                     data.status = $('#search_status').val();
                     data.service_address = $('#search_service_address').val();
                     data.from_date = $('#startdate').val();
                     data.to_date = $('#enddate').val();
                  }
                  // ,
                  // success: function(data){
                  //   console.log(data);
                  // }
                 },
          "columns": columns
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

    $( function() {
    var dateFormat = "yy-mm-dd",
      from = $( "#startdate" )
        .datepicker({
          defaultDate: "+1w",
          dateFormat:dateFormat,
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#enddate" ).datepicker({
        defaultDate: "+1w",
        dateFormat:dateFormat,
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });

    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }
  } );
</script>
@stop
