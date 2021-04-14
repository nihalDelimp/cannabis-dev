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
          <div class="form-group col-sm-6 col-md-4">
          <!-- <label for="Word">@lang('word')</label> -->
          <input class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" name="name" type="text" id="name" placeholder="@lang(strtolower('Name'))">
          </div>
          </div>

          <div class="row">
          <div class="form-group col-sm-12">
          <a href="#" class="btn btn-primary" id="search">@lang(strtolower('search'))</a>
          <a href="#" class="btn btn-primary" id="reset">@lang(strtolower('reset'))</a>
          </div>
          </div>
          </form>
        </div>
      </div>
      <table id="leads" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>@lang(strtolower('Sn.'))</th>
          <th>@lang(strtolower('Name'))</th>
          <th>@lang(strtolower('Hint'))</th>
          <th>@lang(strtolower('Action'))</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
          <th>@lang(strtolower('Sn.'))</th>
          <th>@lang(strtolower('Name'))</th>
          <th>@lang(strtolower('Hint'))</th>
          <th>@lang(strtolower('Action'))</th>
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
                   url: "{{ route('getTemplates',app()->getLocale()) }}",
                   dataType: "json",
                   type: "POST",
                   data:function(data) {
                    data.name = $('#name').val();
                  }
                  // ,
                  // success: function(data){
                  //   console.log(data);
                  // }
                 },
          "columns": [
            { "data": "sn" },
            { "data": "name" },
            { "data": "hint" },
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
