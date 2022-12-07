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
              <div class="form-group col-sm-3 col-md-3">
                <label for="petrol_saved">Select Event<i class="fa fa-star text-red" aria-hidden="true"></i></label>
                  <select class="form-control event_select2" id="event_id"  name="event_id">
                    <option value="">-Select Event-</option>
                    @foreach($events as $event)
                        <option value="{{$event->id}}">{{$event->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="form-group col-sm-3 col-md-3">
                <label for="petrol_saved">Select Position<i class="fa fa-star text-red" aria-hidden="true"></i></label>
                {{-- {{ config('userDetail.admin.user.positions')[2] }} --}}
                  <select class="form-control" id="position_id"  name="position">
                    <option value="">-Select Position-</option>
                    @foreach(config('userDetail.admin.user.positions') as $key => $position)
                    <option value='{{$key}}'>{{$position}} </option>
                    @endforeach
                    {{-- <option value='1'>Store owner </option>
                    <option value='2'>Brand owner</option>
                    <option value='3'>Budtender</option>
                    <option value='4'>Buyer</option>
                    <option value='5'>Exec/Management</option>
                    <option value='6'>Sales Rep</option>
                    <option value='7'>Brand Ambassador</option>
                    <option value='8'>Influencer/Content Creator</option>
                    <option value='9'>Other</option> --}}
                  </select>
              </div>
              <div class="form-group col-sm-3 col-md-3">
                <label for="petrol_saved">Organization<i class="fa fa-star text-red" aria-hidden="true"></i></label>
                  <input type="text" class="form-control" id="organization_id"  name="organization">
                    
              </div>
              <div class="form-group col-sm-3 col-md-3">
                <label for="petrol_saved">Alright user<i class="fa fa-star text-red" aria-hidden="true"></i></label>
                  <select class="form-control" id="participate_id"  name="participate">
                    <option value="">-Select-</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                   
                    
                  </select>
              </div>
              
            
            </div>

            <div class="row">
              <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary" id="search">{{langMessage('Search')}}</button>
                <a href="#" class="btn btn-primary" id="reset">{{langMessage('reset')}}</a>
                <a href="#" class="btn btn-primary" style="display: none" id="downloadPdf">{{langMessage('Download CSV')}}</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <input type="hidden" id="count_data" value='0'>
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
          <th>{{langMessage('Alright user')}}</th>
          {{-- <th>{{langMessage('Is participated user')}}</th> --}}
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
                    data.participate = $('#participate_id').val();
                    data.position = $('#position_id').val();
                    data.organization = $('#organization_id').val();
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
          ],
          "drawCallback": function( settings ) {
             console.log(settings.json.data.length);
            if(settings.json.data.length > 0) {
              $('#downloadPdf').show();
            }
             
           }

      });

      $('body').on('change','#position_id', function () {
        $('#downloadPdf').hide();
      });
      $('body').on('change','#participate_id', function () {
        $('#downloadPdf').hide();
      });
      $('body').on('keyup','#organization_id', function () {
        $('#downloadPdf').hide();
      });

      $('#search').on('click', function (event) {
        event.preventDefault();
        table.draw();
       
        let url =  "{{ route('downloadPdf',app()->getLocale())}}";

        
        
        
        let event_id = $('#event_id').val();
        let participate = $('#participate_id').val();
        let position = $('#position_id').val();
        let organization = $('#organization_id').val();
        let insterested_status = $('#statusId').val();
        url = url+"?event_id="+event_id+"&participate="+participate+"&position="+position+"&organization="+organization;
        if(event_id != '') {
         var countData = $('#count_data').val();
         console.log("kkdfj : ",countData);
         
          $('#downloadPdf').attr('href',url);
        }
         
        
        
        
        
      });
      
      $('#reset').on('click', function(event){
        event.preventDefault();
        $("#search-form")[0].reset();
        $("#select2-event_id-container").html('');
        $('#downloadPdf').hide();
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
