@extends('layouts.default')
<style type="text/css">
  .parsley-errors-list {
  list-style: none;
  color: rgb(248, 0, 0);
  padding: 0;
  }
  .parsley-required li{
  font-size: 14px;
  line-height: 18px;
  color: red;
  margin-top: 6px;
  }
</style>
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
                <label for="petrol_saved">Select Event<i class="fa fa-star text-red" aria-hidden="true"></i></label>
                  <select class="form-control event_select2" id="event_id"  name="event_id" required data-parsley-required-message="Please Select Event">
                    <option value="">-Select Event-</option>
                    @foreach($events as $event)
                        <option value="{{$event->id}}">{{$event->name}}</option>
                    @endforeach
                  </select>
              </div>
              
            
            </div>

            <div class="row">
              <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary" id="search">{{langMessage('Search')}}</button>
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
          <th>{{langMessage('Name')}}</th>
          <th>{{langMessage('Email')}}</th>
          <th>{{langMessage('Phone')}}</th>
          <th>{{langMessage('Organization')}}</th>
          <th>{{langMessage('DOB')}}</th>
          <th>{{langMessage('Position')}}</th>
          <th>{{langMessage('Instagram Name')}}</th>
          <th>{{langMessage('Interested')}}</th>
          <th>{{langMessage('Is participated user')}}</th>
          <th>{{langMessage('Invited Owner')}}</th>
          {{-- <th>{{langMessage('Action')}}</th> --}}
        </tr>
        </thead>
        {{-- <tfoot>
          <tr>
          <th>{{langMessage('Sn.')}}</th>
          <th>{{langMessage('Name')}}</th>
          <th>{{langMessage('Email')}}</th>
          <th>{{langMessage('Phone')}}</th>
          <th>{{langMessage('Organization')}}</th>
          <th>{{langMessage('DOB')}}</th>
          <th>{{langMessage('Position')}}</th>
          <th>{{langMessage('Instagram Name')}}</th>
          <th>{{langMessage('Interested')}}</th>
          <th>{{langMessage('Invited Owner')}}</th>
          {{-- <th>{{langMessage('Action')}}</th> --/}}
          </tr>
        </tfoot> --}}
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
<script src="{{ asset('dist/parsley/parsley.min.js') }}"></script> 
<script>
    
    $(document).ready(function() {
      
      $('.event_select2').select2();
        // $('#sendInvoice').on('submit', function(e){
        //     $('#addSave').prop('disabled', true);
        //     $('#addSave').html('Please wait...');
        // });
    });

    $(function(){
      var table = $('#leads').DataTable({
          'pageLength':10,
          'lengthChange': false,
          'searching'   : false,
          "processing": true,
          "serverSide": true,
          "order": [[ 0, "desc" ]],
          "ajax":{
                  url: "{{ route('getRegisteredUsers',app()->getLocale()) }}",
                  dataType: "json",
                  type: "POST",
                  data:function(data) {
                    data.event_id = $('#event_id').val();
                    data.insterested_status = $('#statusId').val();
                  }
                  // ,
                  // success: function(data){
                  //   console.log(data);
                  // }
                }, 
          "columns": [
            { "data": "sn" },
            { "data": "name" },
            { "data": "email" },
            { "data": "phone" },
            { "data": "organization" },            
            { "data": "dob" },            
            { "data": "position" },            
            { "data": "instagram_name" },            
            { "data": "invited_owner" },            
            { "data": "is_validate" },            
            { "data": "insterested_status" },
            // { "data": "options" }
          ]

      });
      $('#search').on('click', function (event) {
        event.preventDefault();
        table.draw();
      });
      $('#reset').on('click', function(event){
        event.preventDefault();
        $("#search-form")[0].reset();
        $("#select2-event_id-container").html('');
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
