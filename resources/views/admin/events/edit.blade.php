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
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{langMessage($error)}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="post" action="{{ route('events.update', [app()->getLocale(),$news->id]) }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="col-md-6">
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Name')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <input type="text" name="name" value="{{ $news->name }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Name')}}" />
          @error('name')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              
              <label for="petrol_saved">{{langMessage('Start Date')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <input type="date" name="start_date" id="start_date" value="{{ \Carbon\Carbon::parse($news->start_date)->format('Y-m-d') }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Start Date')}}" />
              @error('start_date')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
            </div>
          </div>
          {{--  start--}}
          <div class="col-md-2">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Set Time')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label> 
              <select class="form-control" name="start_time[]">
                @for ($i = 1; $i <= 12; $i++)
                <option value="{{$i}}" {{$i == $news->start_time[0] ? 'selected':''}}>{{$i}}</option>
                @endfor
              </select>
             </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Set Minute')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <select class="form-control" name="start_time[]">
                @for ($i = 0; $i <= 4; $i++)
                  
                  @if($i == 4) 
                  @php
                  $num = $i*15-1;
                  @endphp
                  <option value="{{$i*15-1}}" {{$num == $news->start_time[1] ? 'selected':''}}> {{$i*15-1}}</option>
                  @else 
                  @php
                  $num = $i*15;
                  @endphp
                  <option value="{{$i*15}}" {{ $num == $news->start_time[1] ? 'selected':''}}>{{$i*15}}</option>
                  @endif
                @endfor
              </select>
             </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Set AM/PM')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <select class="form-control" name="start_time[]">
                
                <option value="AM" {{ "AM" == $news->start_time[2] ? 'selected':''}}>AM</option>
                <option value="PM" {{ "PM" == $news->start_time[2] ? 'selected':''}}>PM</option>
                
              </select>
            </div>
          </div>
          {{-- end --}}
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            
              <label for="petrol_saved">{{langMessage('End Date')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <input type="date" name="end_date" id="end_date" value="{{ \Carbon\Carbon::parse($news->end_date)->format('Y-m-d') }}" class="form-control disableEndTime" placeholder="{{langMessage('End Date')}}" />
              @error('end_date')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
            </div>
          </div>
          {{-- srart --}}
          <div class="col-md-2">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Set Time')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <select class="form-control disableEndTime" name="end_time[]">
                @for ($i = 1; $i <= 12; $i++)
                <option value="{{$i}}" {{$i == $news->end_time[0] ? 'selected':''}}>{{$i}}</option>
                @endfor
              </select>
             </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Set Minute')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <select class="form-control disableEndTime" name="end_time[]">
                @for ($i = 0; $i <= 4; $i++)
                  @if($i == 4) 
                  @php
                  $num = $i*15-1;
                  @endphp
                  <option value="{{$i*15-1}}" {{$num == $news->end_time[1] ? 'selected':''}}> {{$i*15-1}}</option>
                  @else 
                  @php
                  $num = $i*15;
                  @endphp
                  <option value="{{$i*15}}" {{ $num == $news->end_time[1] ? 'selected':''}}>{{$i*15}}</option>
                  @endif
                @endfor
              </select>
             </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Set AM/PM')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <select class="form-control disableEndTime" name="end_time[]">
                
                <option value="AM" {{ "AM" == $news->end_time[2] ? 'selected':''}}>AM</option>
                <option value="PM" {{ "PM" == $news->end_time[2] ? 'selected':''}}>PM</option>
                
              </select>
            </div>
          </div>
          {{-- end --}}

        </div>
        
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Discription')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <textarea name="discription" rows="8" cols="80" class="form-control textarea border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="@lang('enter your discription')">{{langMessage('enter your discription')}} {{ $news->discription}}</textarea>
          @error('discription')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Status')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <select class="form-control" name="status">
            <option value="1" {{ $news->status == '1' ?'selected':''}}>{{langMessage('Active')}}</option>
            <option value="2" {{ $news->status == '2' ?'selected':''}}>{{langMessage('Inactive')}}</option>
          </select>
          @error('status')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
        {{-- <div class="form-group">
          <label for="petrol_saved">{{langMessage('Category')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <select class="form-control" name="category_id">
            @if(!$categories->isEmpty())
              <option value="">{{langMessage('Select')}}</option>
              @foreach($categories as $category)
                <option value="{{$category->id}}" {{ old('category_id') == $category->id ?'selected':''}}>{{langMessage($category->title)}}</option>
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
        </div> --}}
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">{{langMessage('Upload Image')}}</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
              <input type="file" name="image_path" class="form-control">
              @error('image_path')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
              </div>
              <div class="form-group">
               
              <img src="{{asset($news->thumbnail_path)}}" alt="">
              {{-- <img src="{{asset('images/events/listing/'.$news->thumbnail_path)}}" alt=""> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="form-group col-sm-12 text-center">
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
  </section>
@stop
@section('pagejs')
<script>
$(document).ready(function(){
  $('.select2').select2();
  $('.textarea').wysihtml5();


  var up_result = new Date($('#start_date').val());
  console.log("dat-",up_result);
  var up_inc_date = up_result.setDate(up_result.getDate());
  var increse_date = moment(up_inc_date).format('YYYY-MM-DD');  
  $("#start_date").attr({
        "min" : increse_date,
        //"value" : increse_date,         // values (or variables) here
  });
  $(".disableEndTime").attr('disabled',true);
  $('body').on('change','#start_date',function(){

    var result = new Date($(this).val());

    console.log("dat re-",result);
    var increse_date = result.setDate(result.getDate() + 1 );
    var end_date = moment(increse_date).format('YYYY-MM-DD');  
    $("#end_date").attr({
          "min" : end_date,
          //"disabled" : false,
          //"value" : increse_date,         // values (or variables) here
    });
    $(".disableEndTime").attr('disabled',false);
  });
});
</script>
@stop
