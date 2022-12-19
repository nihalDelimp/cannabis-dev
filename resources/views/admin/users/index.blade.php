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
            <div class="form-group col-sm-3 col-md-3">
              <!-- <label for="Word">@lang('word')</label> -->
              <label for="petrol_saved">Name<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <input class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" name="name" type="text" id="name" placeholder="{{langMessage('User Name')}}">
            </div>
            <div class="form-group col-sm-3 col-md-3">
              <label for="petrol_saved">Select Position<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              {{-- {{ config('userDetail.admin.user.positions')[2] }} --}}
                <select class="form-control" id="position_id"  name="position">
                  <option value="">-Select Position-</option>
                  @foreach(config('userDetail.admin.user.positions') as $key => $position)
                  <option value='{{$key}}'>{{$position}} </option>
                  @endforeach
                </select>
            </div>
            <div class="form-group col-sm-3 col-md-3">
              <label for="petrol_saved">Organization<i class="fa fa-star text-red" aria-hidden="true"></i></label>
                <input type="text" class="form-control" id="organization_id"  name="organization">
                  
            </div>
            <div class="form-group col-sm-3 col-md-3">
              <label for="petrol_saved">Content with us<i class="fa fa-star text-red" aria-hidden="true"></i></label>
                <select class="form-control" id="statusId"  name="insterested_status">
                  <option value="">-Select-</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                 
                  
                </select>
            </div>

            {{-- <div class="form-group col-sm-6 col-md-4">
              <select class="form-control" name="status" id="statusId">
                
                  <option value="">{{langMessage('Select Insterested User')}}</option>
                  <option value=1>{{langMessage('Yes')}}</option>
                  <option value=0>{{langMessage('No')}}</option>
              </select>
            </div> --}}
            {{-- <div class="form-group col-sm-6 col-md-4">
              <!-- <label for="petrol_saved">{{langMessage('Events')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label> -->
              <select class="form-control" name="user_id" id="user_id">
                @if(!$categories->isEmpty())
                  <option value="">{{langMessage('Select Category')}}</option>
                  @foreach($categories as $category)
                    <option value="{{$category->id}}">{{langMessage($category->title)}}</option>
                  @endforeach
                @else
                    <option value="">{{langMessage('Empty')}}</option>
                @endif
              </select>
              @error('event_id')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
            </div> --}}
          </div>

          <div class="row">
          <div class="form-group col-sm-12">
          <a href="#" class="btn btn-primary" id="search">{{langMessage('search')}}</a>
          <a href="#" class="btn btn-primary" id="reset">{{langMessage('reset')}}</a>
          <a href="#" class="btn btn-primary" style="display: none" id="downloadPdf">{{langMessage('Download CSV')}}</a>
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
          <th>{{langMessage('Content with us')}}</th>
          {{-- <th>{{langMessage('Interested')}}</th> --}}
          <th>{{langMessage('Invited Owner')}}</th>
          <th>{{langMessage('Action')}}</th>
        </tr>
        </thead>
        <tfoot>
          <tr>
          <th>{{langMessage('Sn.')}}</th>
          <th>{{langMessage('Name')}}</th>
          <th>{{langMessage('Email')}}</th>
          <th>{{langMessage('Phone')}}</th>
          <th>{{langMessage('Organization')}}</th>
          <th>{{langMessage('DOB')}}</th>
          <th>{{langMessage('Position')}}</th>
          <th>{{langMessage('Instagram Name')}}</th>
          <th>{{langMessage('Content with us')}}</th>
          <th>{{langMessage('Invited Owner')}}</th>
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
          "order": [[ 0, "desc" ]],
          "ajax":{
                   url: "{{ route('getUsers',app()->getLocale()) }}",
                   dataType: "json",
                   type: "POST",
                   data:function(data) {
                    data.name = $('#name').val();
                    // data.event_id = $('#event_id').val();
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
                      
            { "data": "insterested_status" },
            { "data": "invited_owner" },  
            { "data": "options" }
          ],
          "drawCallback": function( settings ) {
             console.log(settings.json.data.length);
             
            if(settings.json.data.length > 0) {
              let name = $('#name').val();
              let position = $('#position_id').val();
              let organization = $('#organization_id').val();
              let insterested_status = $('#statusId').val();
              let url =  "{{ route('downloadUserCsv',app()->getLocale())}}";
              url = url+"?name="+name+"&position="+position+"&organization="+organization+"&insterested_status="+insterested_status;
              $('#downloadPdf').attr('href',url);
              $('#downloadPdf').show();
             
            } else {
              $('#downloadPdf').hide();
            }
             
           }

      });
      $('#search').on('click', function (event) {
        event.preventDefault();
        table.draw();

        let url =  "{{ route('downloadUserCsv',app()->getLocale())}}";
        
        
        let name = $('#name').val();
        let position = $('#position_id').val();
        let organization = $('#organization_id').val();
        let insterested_status = $('#statusId').val();
        url = url+"?name="+name+"&position="+position+"&organization="+organization+"&Content-with-us="+insterested_status;
        $('#downloadPdf').attr('href',url);

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
