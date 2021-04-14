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
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title">@lang('search')</h3>
        </div>
        <div class="box-body">
          <form id="search-form">
          <div class="row">
            <div class="form-group col-sm-3">
            <label for="Name">@lang('name')</label>
            <input class="form-control" name="name" type="text" id="Name" placeholder="@lang('name')">
            </div>
            <div class="form-group col-sm-3">
            <label for="Email">@lang('email')</label>
            <input class="form-control" name="email" type="text" id="Email" placeholder="@lang('email')">
            </div>
            <div class="form-group col-sm-3">
            <label for="Phone">@lang('phone')</label>
            <input class="form-control" name="phone" type="text" id="Phone" placeholder="@lang('phone')">
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
            <a href="#" class="btn btn-primary" id="search">@lang('search')</a>
            <a href="#" class="btn btn-primary" id="reset">@lang('reset')</a>
          </div>
        </form>
        </div>
      </div>
      
            <table id="leads" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>@lang('name')</th>
          <th>@lang('email')</th>
          <th>@lang('phone')</th>
          <th>@lang('action')</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
          <th>@lang('name')</th>
          <th>@lang('email')</th>
          <th>@lang('phone')</th>
          <th>@lang('action')</th>
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
          "order": [[ 3, "desc" ]],
          "ajax":{
                   url: "{{ route('getadmins',app()->getLocale()) }}",
                   dataType: "json",
                   type: "POST",
                   data:function(data) {
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
    })
</script>
@stop
