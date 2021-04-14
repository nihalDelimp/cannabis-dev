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
            <label for="Name">{{langMessage('company name')}}</label>
            <input class="form-control" name="name" type="text" id="Company_Name" placeholder="{{langMessage('company name')}}">
            </div>
            <div class="form-group col-sm-3">
            <label for="Name">{{langMessage('representative name')}}</label>
            <input class="form-control" name="name" type="text" id="Name" placeholder="{{langMessage('representative name')}}">
            </div>
            <div class="form-group col-sm-3">
            <label for="Email">{{langMessage('email')}}</label>
            <input class="form-control" name="email" type="text" id="Email" placeholder="{{langMessage('email')}}">
            </div>
            <div class="form-group col-sm-3">
            <label for="Phone">{{langMessage('phone')}}</label>
            <input class="form-control" name="phone" type="text" id="Phone" placeholder="{{langMessage('phone')}}">
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
            <a href="#" class="btn btn-primary" id="refresh">{{langMessage('refresh')}}</a>
          </div>
        </form>
        </div>
      </div>
      <table id="leads" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>{{langMessage('company name')}}</th>
          <th>{{langMessage('representative name')}}</th>
          <th>{{langMessage('email')}}</th>
          <th>{{langMessage('phone')}}</th>
          <th>{{langMessage('action')}}</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
          <th>{{langMessage('company name')}}</th>
          <th>{{langMessage('representative name')}}</th>
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
          "order": [[ 4, "desc" ]],
          "ajax":{
                   url: "{{ route('getcompanies',app()->getLocale()) }}",
                   dataType: "json",
                   type: "POST",
                   data:function(data) {
                    data.company_name = $('#Company_Name').val();
                    data.name = $('#Name').val();
                    data.email = $('#Email').val();
                    data.phone = $('#Phone').val();
                    data.from_date = $('#startdate').val();
                    data.to_date = $('#enddate').val();
                  }
                  // ,
                  // success: function(data){
                  //   console.log(data);
                  // }
                 },
          "columns": [
              { "data": "company_name" },
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

      setInterval(function(){
        table.draw();
      },30000);

      $("#refresh").click(function(){
        table.draw();
      });
    });
</script>
@stop
