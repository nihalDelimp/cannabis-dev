@extends('layouts.default')
@section('content')
  <section class="content-header">
    <h1>
      {{langMessage('dashboard')}}
      <small>{{langMessage($pageHeading)}}</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> {{langMessage('dashboard')}}</a></li>
      <li class="active">{{langMessage($pageHeading)}}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{langMessage($pageHeading)}}</h3>
          </div>
          <!-- /.box-header -->
    <div class="box-body">
      @if($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{langMessage($message)}}</p>
      </div>
      @endif
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title">{{langMessage('search')}}</h3>
        </div>
        <div class="box-body">
          <form id="search-form">
          <div class="row">
          <div class="form-group col-sm-6 col-md-4">
          <!-- <label for="Word">@lang('word')</label> -->
          <input class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" name="name" type="text" id="title" placeholder="{{langMessage('Title')}}">
          </div>
          <div class="form-group col-sm-6 col-md-4">
            <!-- <label for="petrol_saved">{{langMessage('Category')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label> -->
            <select class="form-control" name="category_id" id="category_id">
              @if(!$categories->isEmpty())
                <option value="">{{langMessage('Select Category')}}</option>
                @foreach($categories as $category)
                  <option value="{{$category->id}}">{{langMessage($category->title)}}</option>
                @endforeach
              @else
                  <option value="">{{langMessage('Empty')}}</option>
              @endif
            </select>
            @error('category_id')
                <span class="text-danger" role="alert">
                    <strong>{{langMessage($message)}}</strong>
                </span>
            @enderror
          </div>
          </div>

          <div class="row">
          <div class="form-group col-sm-12">
          <a href="#" class="btn btn-primary" id="search">{{langMessage('search')}}</a>
          <a href="#" class="btn btn-primary" id="reset">{{langMessage('reset')}}</a>
          </div>
          </div>
          </form>
        </div>
      </div>
      <table id="leads" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>{{langMessage('Sn.')}}</th>
          <th>{{langMessage('Title')}}</th>
          <th>{{langMessage('Category')}}</th>
          <th>{{langMessage('Status')}}</th>
          <th>{{langMessage('Created')}}</th>
          <th>{{langMessage('Action')}}</th>
        </tr>
        </thead>
        <tfoot>
          <tr>
            <th>{{langMessage('Sn.')}}</th>
            <th>{{langMessage('Title')}}</th>
            <th>{{langMessage('Category')}}</th>
            <th>{{langMessage('Status')}}</th>
            <th>{{langMessage('Created')}}</th>
            <th>{{langMessage('Action')}}</th>
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
                   url: "{{ route('getNews',app()->getLocale()) }}",
                   dataType: "json",
                   type: "POST",
                   data:function(data) {
                    data.title = $('#title').val();
                    data.category_id = $('#category_id').val();
                  }
                  // ,
                  // success: function(data){
                  //   console.log(data);
                  // }
                 },
          "columns": [
            { "data": "sn" },
            { "data": "name" },
            { "data": "category.title" },
            { "data": "status" },
            { "data": "created_at" },
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
