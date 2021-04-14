@extends('layouts.default')
@section('content')
  <style media="screen">
    .ui-datepicker td.no-available-date span{background-color: #EEAA55 !important;}
  </style>
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
    <form method="post" action="{{ route('job.store',app()->getLocale()) }}" enctype="multipart/form-data" class="form">
    @csrf
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="job_type">{{langMessage('Job Type')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="job_type" id="job_type">
      <option value="1" {{ old('job_type') == 1 ? 'selected' : '' }}>{{langMessage('Regular Job')}}</option>
      <option value="2" {{ old('job_type') == 2 ? 'selected' : '' }}>{{langMessage('Alternative Job')}}</option>
    </select>
    @error('job_type')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="company_id">{{langMessage('company')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="company_id" id="company_id" required onchange="getSalesReps(this.value)">
      <option value="">{{'select'}}</option>
    </select>
    @error('company_id')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="user_id">{{langMessage('sales representative')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control sales-representatives" name="user_id" id="user_id" required>
      <option value="">{{'select'}}</option>
    </select>
    @error('user_id')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="service_id">{{langMessage('service')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="service_id" id="service_id" required onchange="selectService(this)">
      <option value="">{{'select'}}</option>
      @if(!$locations->isEmpty())
        @foreach($services as $service)
          <option value="{{$service->id}}" data-slug = "{{$service->slug}}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{$service->service_name}}</option>
        @endforeach
      @endif
    </select>
    @error('service_id')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="location_id">{{langMessage('service location')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="location_id" id="location_id" required onchange="selectLocation(this.value)">
      <option value="">{{'select'}}</option>
      @if(!$locations->isEmpty())
        @foreach($locations as $location)
          <option value="{{$location->id}}" {{ old('location_id') == $location->id ? 'selected' : '' }}>{{$location->location_name}}</option>
        @endforeach
      @endif
    </select>
    @error('location_id')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-12">
      <h4 class="box-title">{{langMessage('customer information')}}</h4>
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
      <label for="customer_name">{{langMessage('booking date')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup><strong id="selectedBookingDate"><strong></label>
      <div id="datepicker"></div>
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <input type="hidden" name="booking_date" id="booking_date" value="" required>
    @error('booking_date')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="customer_name">{{langMessage('customer name')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="customer_name" value="{{ old('customer_name') }}" type="text" id="customer_name" placeholder="{{langMessage('customer name')}}" required>
    @error('customer_name')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="service_address">{{langMessage('service address')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="service_address" value="{{ old('service_address') }}" type="text" id="service_address" placeholder="{{langMessage('service address')}}" required>
    @error('service_address')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="city">{{langMessage('city')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="city" value="{{ old('city') }}" type="text" id="city" placeholder="{{langMessage('city')}}" required>
    @error('city')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="zip_code">{{langMessage('zip code')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="zip_code" value="{{ old('zip_code') }}" type="text" id="zip_code" placeholder="{{langMessage('zip code')}}" required>
    @error('zip_code')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="phone_number">{{langMessage('phone number')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <div class="input-group">
    <span class="input-group-addon">+1</span>
    <input class="form-control" name="phone_number" value="{{ old('phone_number') }}" type="text" id="phone_number" placeholder="{{langMessage('phone number')}}" required>
    </div>
    @error('phone_number')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="cell_number">{{langMessage('cell number')}}</label>
    <div class="input-group">
    <span class="input-group-addon">+1</span>
    <input class="form-control" name="cell_number" value="{{ old('cell_number') }}" type="text" id="cell_number" placeholder="{{langMessage('cell number')}}">
    </div>
    @error('cell_number')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div id="service-form-container">

    </div>
    <!-- <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="upload_file">{{langMessage('upload file')}}</label>
    <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
    <input class="form-control" name="upload_file[]" multiple type="file" id="upload_file" placeholder="{{langMessage('upload file')}}">
    </div>
    @error('upload_file')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div> -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{ langMessage('Upload Files') }}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="form-group col-md-12 warehouseBannerSection">
            <div class="uplod-mg-size" id="custom-imageUploadSection">
            <div class="custom-image-container">

            </div>
            <div class="input_img Image_Upload"><input type="file" name="upload_file" onchange="uploadImge(this)"></div>
            </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <div class="form-group col-sm-12 text-center">
      <input type="hidden" name="token" value="{{$token}}">
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
$(document).tooltip();
var job_type = 1;
$("select[name=job_type]").on('change', function(){
  job_type = $(this).val();
  var location_id = $("#location_id").val();
  if(location_id!=""){
    selectLocation(location_id);
  }
});
var selectLocation = function(value){
    //var value = $(value);
    if(job_type == 1){
      getMonthAllDates(value);
    }
    $("#datepicker").datepicker("refresh");
    $('#datepicker').datepicker({
        minDate:0,
        maxDate: "+2M",
        dateFormat:"yy-mm-dd",
        //altField:'#booking_date',
        beforeShowDay: function(date){
          var cal_day = date.getDay();
          var noWeekend = $.datepicker.noWeekends(date);
          if(cal_day != 0){
            var available_count = 0;
            var flag = false;
            var cls = "";
            var day = $.datepicker.formatDate('yy-mm-dd', date);
            if(job_type == 1){
              var date_range = JSON.parse(dateArray);
              available_count = date_range[day];
              flag = (date_range[day] == 0 || typeof date_range[day] === "undefined")?false:true;
              cls = (date_range[day] == 0 || typeof date_range[day] === "undefined")?'no-available-date':'available-date';
              return [flag, cls,"Available:"+available_count];
            }
            else{
              return [true, "available-date","Available"];
            }
          }
          else{
            return noWeekend;
          }
        },
        onSelect: function(dateText) {
          $('#booking_date').val(dateText);
          $('#selectedBookingDate').html(':'+dateText);
        }
       });
}

var selectService = function(value){
  var value = $(value);
  $.ajax({
    url:'{{ route("getserviceform",app()->getLocale()) }}',
    method:'post',
    data:{service_slug:value.find('option:selected').attr('data-slug')},
    beforeSend: function(){
      // $(".oeTimeContainer").html('');
      // $('form input[name=add]').attr('disabled','disabled');
    },
    success: function(json){
      console.log(json);
      $("#service-form-container").html(json);
    }
  })

  if($("#location_id").val()!=""){
    selectLocation($("#location_id").val());
  }
}
var dateArray = '';
var getMonthAllDates = function(value){
   $.ajax({
        url:'{{route("getavailability",app()->getLocale())}}',
        method:'post',
        async:false,
        data:{location_id:value,service_id:$("#service_id").val()},
        success: function(result){
          dateArray = result;
        }
      });
}

var getSalesReps = function(company_id){
  $.ajax({
       url:'{{route("getselectedcompanysalesusers",app()->getLocale())}}',
       method:'post',
       data:{company_id:company_id},
       success: function(result){
         $(".sales-representatives").html(result);
       }
     });
}

   var uploadImge = function(element){
   var env = $(element);
   var file_data = $(element).prop('files')[0];

   var form_data = new FormData();
   form_data.append('upload_file', file_data);
   form_data.append('token', '{{$token}}');
   $.ajax({
   url: '{{ route("upload_image",app()->getLocale()) }}',
   dataType: 'json',
   cache: false,
   contentType: false,
   processData: false,
   data: form_data,
   type: 'post',
   beforeSend: function(){
   removeAlert();
   env.parent().prepend('<i class="fa fa-cog fa-spin fa-1x fa-fw text-success custom-image-upload-process"></i>');
   },
   success: function (json) {
   if($.trim(json.status) == 1){
   $(".custom-image-container").append(json.image_element);
   }
   else{
   error_Attr('custom-imageUploadSection',json.message);
   }
   env.parent().find(".custom-image-upload-process").remove();
   }
   });
   }

   $("body").on('click','.custom-image-container .input_img a.remove', function(e){
     e.preventDefault();
     var element = $(this);
     $.ajax({
       url: '{{ route("remove_uploaded_image",app()->getLocale()) }}',
       dataType: 'json',
       type: 'post',
       data:{id:$(this).attr('image-id')},
       beforeSend: function(){
         removeAlert();
         element.html('<i class="fa fa-cog fa-spin fa-1x fa-fw text-success custom-image-upload-process"></i>');
       },
       success: function (json) {
         if(json.status == 1){
           successing_Attr('custom-imageUploadSection',json.message);
           element.parent().remove();
         }
         else{
           error_Attr('custom-imageUploadSection',json.message);
         }
       }
     });
   });

  $('#company_id').bind('mouseover', function(){
    $.ajax({
      url:'{{ route("getcompaniesname",app()->getLocale()) }}',
      method: 'post',
      success: function (result) {
        $("#company_id").html(result);
      }
    });
  });
</script>
@stop
