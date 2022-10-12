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
    <form method="post" action="{{ route('events.store', app()->getLocale()) }}" enctype="multipart/form-data" id="createForm">
     
      @csrf
      <div class="col-md-6">
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Name')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <input type="text" name="name" value="{{ old('name') }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Name')}}" />
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
              <input type="text" name="start_date" id="start_date" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Start Date')}}" />
              @error('start_date')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Set Time')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <select class="form-control" name="start_time[]">
                @for ($i = 0; $i <= 12; $i++)
                <option value="{{$i}}">{{ sprintf("%02d", $i)}}</option>
                @endfor
              </select>
             </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Set AM/PM')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <select class="form-control" name="start_time[]">
                
                  <option value="">-select-</option>
                  <option value="am">AM</option>
                 
                  <option value="pm">PM</option>
                 
              </select>
             </div>
          </div>
         {{-- <div class="col-md-2">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Set Second')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <select class="form-control" name="start_time[]">
                
                @for ($i = 0; $i <= 59; $i++)
                <option value="{{$i}}">{{sprintf("%02d", $i)}}</option>
                @endfor
                
              </select>
            </div>
          </div> --}}
        </div>
        {{-- <div class="form-group">
          <label for="petrol_saved">{{langMessage('Start Date')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Start Date')}}" />
          @error('start_date')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div> --}}
        {{-- <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('End Date')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <input type="text" name="end_date" id="end_date" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3 disableEndTime " placeholder="{{langMessage('End Date')}}" />
              @error('end_date')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Set Time')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <select class="form-control disableEndTime" name="end_time[]">
                @for ($i = 1; $i <= 23; $i++)
                <option value="{{$i}}">{{sprintf("%02d", $i)}}</option>
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
                  <option value="{{$i*15-1}}">{{$i*15-1}}</option>
                  @else 
                  <option value="{{$i*15}}">{{sprintf("%02d", $i*15)}}</option>
                  @endif
                @endfor
              </select>
             </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Set Second')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <select class="form-control disableEndTime" name="end_time[]">
                
                @for ($i = 0; $i <= 59; $i++)
                <option value="{{$i}}">{{sprintf("%02d", $i)}}</option>
                @endfor
                
              </select>
            </div>
          </div>

        </div> --}}
        
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Discription')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <textarea name="discription" rows="8" cols="80" class="form-control textarea border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="@lang('enter your discription')">{{langMessage('enter your discription')}}</textarea>
          @error('discription')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-6">
            <label for="petrol_saved">{{langMessage('Status')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
            <select class="form-control" name="status">
              <option value=1>{{langMessage('Active')}}</option>
              <option value=0>{{langMessage('Inactive')}}</option>
            </select>
            @error('status')
                <span class="text-danger" role="alert">
                    <strong>{{langMessage($message)}}</strong>
                </span>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="petrol_saved">User List<i class="fa fa-star text-red" aria-hidden="true"></i></label>
            <select class="form-control select2"  name="user_id[]" multiple="multiple">
              @foreach($users as $user)
                   <option value="{{$user->email}}">{{$user->email}}</option>
              @endforeach
            </select>
            
          </div>
        </div>
        
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Image')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          
          
        </div>
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
          </div>
        </div>
      </div>
        <div class="form-group col-sm-12 text-center">
        <input class="btn btn-primary" name="add" id="addSave" type="submit" value="{{langMessage('add')}}">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> 
<script>
  
  $('.select2').select2({
      // createTag: function (params) {
      //     var term = $.trim(params.term);
  
      //     if (term === '') {
      //         return null;
      //     }
      //     return {
      //         id: term,
      //         text: term,
      //         newTag: true // add additional parameters
      //     }
      // },
      createTag: function (params) {
        // Don't offset to create a tag if there is no @ symbol
        if (params.term.indexOf('@') === -1) {
          // Return null to disable tag creation
          return null;
        }

        return {
          id: params.term,
          text: params.term
        }
      },
      tags: true,
      minimumInputLength: 2,
      tokenSeparators: [','],
      // ajax: {
          // url: "{{-- route('country.list') =--}}",
      //     dataType: "json",
      //     type: "GET",
      //     data: function (params) {
      //         console.log(params);
      //         var queryParameters = {
      //             query: params.term
      //         }
      //         return queryParameters;
      //     },
      //     processResults: function (data) {
      //         return {
      //             results: $.map(data, function (item) {
  
      //                 return {
      //                     text: item.name,
      //                     id: item.id
      //                 }
      //             })
      //         };
      //     }
      // }
  });
</script>
<script>
  $(document).ready(function(){
    $('#end_date').datepicker();
    
    $('.textarea').wysihtml5();
    ////////////////
    // var up_result = new Date();
    // console.log("dat-",up_result);
    // var up_inc_date = up_result.setDate(up_result.getDate());
    // var increse_date = moment(up_inc_date).format('YYYY-MM-DD');  
    // $("#start_date").attr({
    //       "min" : increse_date,
    //       //"value" : increse_date,         // values (or variables) here
    // });
    $(".disableEndTime").attr('disabled',true);
    let today = new Date();
    $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#start_date" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          minDate: today,
          
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#end_date" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
      function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
  
        return date;
      }
    } );
    $('body').on('change','#start_date',function(){

      var result = new Date($(this).val());

      console.log("dat re-",result);
      var increse_date = result.setDate(result.getDate() + 1 );
      var end_date = moment(increse_date).format('YYYY-MM-DD');  
      // $("#end_date").attr({
      //       "min" : end_date,
      //       //"disabled" : false,
      //       //"value" : increse_date,         // values (or variables) here
      // });
      $(".disableEndTime").attr('disabled',false);
    });

    
  });
  $(document).ready(function(){
        $('#createForm').on('submit', function(e){
            //alert("hdljflksdf");
            $('#addSave').prop('disabled', true);
            // $(e.originalEvent.submitter).prop('disabled', true);
            $('#addSave').attr('value','Please wait...');
        });
    });
</script>
@stop
