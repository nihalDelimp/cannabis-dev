@extends('layouts.default')
@section('content')
  <section class="content-header">
    <h1>
      {{langMessage('dashboard')}}
      <small>{{langMessage(strtolower($pageHeading))}}</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard',app()->getLocale()) }}"><i class="fa fa-dashboard"></i> {{langMessage('dashboard')}}</a></li>
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
      <h5><strong>{{langMessage('Company:')}}</strong> {{$job->company_name}}, <i class="fa fa-phone-square" aria-hidden="true"></i> {{$job->company_phone}}</h5>
      <h5><strong>{{langMessage('Sales Representative:')}}</strong> {{$job->sales_rep}}, <i class="fa fa-phone-square" aria-hidden="true"></i> {{$job->sales_rep_phone}}</h5>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{langMessage(strtolower($error))}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="post" action="{{ route('job.update',['id'=>$job->id,'locale'=>app()->getLocale()]) }}" enctype="multipart/form-data" class="form">
    @csrf
    @method('PATCH')
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="location_id">{{langMessage('service location')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="location_id" id="location_id" required disabled>
      <option value="">{{'select'}}</option>
      @if(!$locations->isEmpty())
        @foreach($locations as $location)
          <option value="{{$location->id}}"  {{ $job->location_id == $location->id ? 'selected' : '' }}>{{$location->location_name}}</option>
        @endforeach
      @endif
    </select>
    @error('location_id')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="service_id">{{langMessage('service')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="service_id" id="service_id" required disabled>
      <option value="">{{'select'}}</option>
      @if(!$locations->isEmpty())
        @foreach($services as $service)
          <option value="{{$service->id}}" data-slug = "{{$service->slug}}" {{ $job->service_id == $service->id ? 'selected' : '' }}>{{$service->service_name}}</option>
        @endforeach
      @endif
    </select>
    @error('service_id')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    @if(in_array($account->role,[1,2]))
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="status">{{langMessage('status')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <select class="form-control" name="status" id="status">
      <option value="0" {{ $job->status == 0 ?'selected':''}}>{{langMessage('pending')}}</option>
      <option value="1" {{ $job->status == 1 ?'selected':''}}>{{langMessage('approved')}}</option>
      <option value="2" {{ $job->status == 2 ?'selected':''}}>{{langMessage('cancelled')}}</option>
      <option value="3" {{ $job->status == 3 ?'selected':''}}>{{langMessage('completed')}}</option>
    </select>
    @error('status')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    @endif
    <div class="form-group col-sm-12">
      <h4 class="box-title">{{langMessage('customer information')}}</h4>
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="customer_name">{{langMessage('booking date')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" type="text" name="booking_date" id="booking_date" value="{{ $job->booking_date }}" disabled>
    @error('booking_date')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="customer_name">{{langMessage('customer name')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="customer_name" value="{{ $job->customer_name }}"  type="text" id="customer_name" placeholder="{{langMessage('customer name')}}" required>
    @error('customer_name')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="service_address">{{langMessage('service address')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="service_address" value="{{ $job->service_address }}" type="text" id="service_address" placeholder="{{langMessage('service address')}}" required>
    @error('service_address')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="city">{{langMessage('city')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="city" value="{{ $job->city }}" type="text" id="city" placeholder="{{langMessage('city')}}" required>
    @error('city')
        <span class="text-danger" role="alert">
            <strong>{{langMessage(strtolower($message))}}</strong>
        </span>
    @enderror
    </div>
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="zip_code">{{langMessage('zip code')}}<sup><i class="fa fa-star text-red" aria-hidden="true"></i></sup></label>
    <input class="form-control" name="zip_code" value="{{ $job->zip_code }}" type="text" id="zip_code" placeholder="{{langMessage('zip code')}}" required>
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
    <input class="form-control" name="phone_number" value="{{ $job->phone_number }}" type="text" id="zip_code" placeholder="{{langMessage('phone number')}}" required>
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
    <input class="form-control" name="cell_number" value="{{ $job->cell_number }}" type="text" id="zip_code" placeholder="{{langMessage('cell number')}}">
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
    @if(!empty($job->upload_file))
    <a download href="{{ url('service_upload_file',$job->upload_file) }}">(<strong><i class="fa fa-download" aria-hidden="true"></i> {{langMessage('attached file')}})</strong></a>
    @endif
    <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
    <input class="form-control" name="upload_file" type="file" id="upload_file" placeholder="{{langMessage('upload file')}}">
    </div>
    </div> -->
    <!-- @if(!empty($job->upload_file))
    <div class="col-sm-6 col-sm-offset-3 form-group">
    <label for="upload_file">{{langMessage('attached file')}}</label>
      <ul class="list-group">
        @foreach(json_decode($job->upload_file) as $key=>$file)
          <li class="list-group-item">
          <a download title="download file" href="{{ url('service_upload_file',$file) }}"><strong><i class="fa fa-download" aria-hidden="true"></i> {{$file}}</strong></a>
          </li>
        @endforeach
      </ul>
    </div>
    @endif -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">@lang(strtolower('Upload Files'))</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="form-group col-md-12 warehouseBannerSection">
            <div class="uplod-mg-size" id="custom-imageUploadSection">
            <div class="custom-image-container">
              <div class="input_img"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
            </div>
            <div class="input_img Image_Upload"><input type="file" name="myFile" onchange="uploadImge(this)"></div>
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
    <input type="hidden" name="service_id" value="{{$job->service_id}}">
    <input class="btn btn-primary" name="add" type="submit" value="{{langMessage('update')}}">
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
    <div class="row">
      <div class="col-md-12">
          <!-- Box Comment -->
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <span class="username"><a href="#">{{langMessage('Comments')}}</a></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                  <i class="fa fa-circle-o"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-footer" style="">
              <form method="post" id="job-comment-form" action="{{ route('job.savecomment',app()->getLocale()) }}">
                <img class="img-responsive img-circle img-sm" src="{{ url('profile/dummy-profile-image.jpg') }}">
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comment" placeholder="Press enter to post comment" required>
                  <input type="hidden" name="job_id" value="{{$job->id}}">
                </div>
              </form>
            </div>
            <div class="box-footer box-comments" style="" id="job-comment-container">

            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
    </div>
  </section>
@stop
@section('pagejs')
<script>
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
      $("#service-form-container").html(json);
    }
  })
}

var selectServiceEdit = function(service_slug,job_id){
  $.ajax({
    url:'{{ route("getserviceform",app()->getLocale()) }}',
    method:'post',
    data:{service_slug:service_slug,job_id:job_id},
    beforeSend: function(){

    },
    success: function(json){
      $("#service-form-container").html(json);
    }
  })
}

selectServiceEdit('{{$job->slug}}','{{$job->id}}');

$(document).ready(function(){
  var comment_count = 0;
  var comment_id = 0;
  var getJobComment = function(){
    $.ajax({
      url:'{{route("job.getjobcomments",app()->getLocale())}}',
      method:'post',
      data:{job_id:'{{$job->id}}',comment_id:comment_id},
      beforeSend: function(){
        console.log("call me: "+comment_count);
      },
      success: function(response){
        if($("#job-comment-container .user-box-comment").length > 0){
          $("#job-comment-container").prepend(response);
        }
        else{
          $("#job-comment-container").html(response);
        }
      }
    });
  }
  var form_options = {
    dataType: "json",
    beforeSubmit: function(formData, jqForm, options){
      var formID = jqForm.attr('id');
    },
    success: function(json, responseText, xhr, form){
      comment_id = json.data.comment_id;
      var formID = form.attr('id');
      $("#"+formID)[0].reset();
      getJobComment();
    }
  };
  $("#job-comment-form").ajaxForm(form_options);
   getJobComment();
});

var checkUploadedImages = function(){
  var data = {};
  data['job_id'] = '{{$job->id}}';
  $.ajax({
    url: '{{ route("check_uploaded_image",app()->getLocale()) }}',
    dataType: 'json',
    type: 'post',
    data:data,
    async: false,
    beforeSend: function(){
    //removeAlert();
    },
    success: function (json) {
      $(".custom-image-container").html('');
      if(json.status == 1){
        $(".custom-image-container").append(json.images);
      }
    }
  });
}

var uploadImge = function(element){
var env = $(element);
var file_data = $(element).prop('files')[0];

var form_data = new FormData();
form_data.append('upload_file', file_data);
form_data.append('job_id', '{{$job->id}}');
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
$(document).ready(function(){
  checkUploadedImages();
});
</script>
@stop