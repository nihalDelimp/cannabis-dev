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
    
      <div class="col-md-6">
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Name')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <label class="form-control border-0 rounded-0 primary-text-color py-2 pl-3">{{ $event->name }}
          </label>
          
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              
              <label for="petrol_saved">{{langMessage('Start Date With Time')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <label  class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" >
                {{ \Carbon\Carbon::parse($event->start_date)->format('m/d/Y  H:i:s') }}
              </label>
            </div>
          </div>
          {{--  start--}}
          
          
          
          {{-- end --}}
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            
              <label for="petrol_saved">{{langMessage('End Date With Time')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <label class="form-control border-0 rounded-0 primary-text-color py-2 pl-3">
                {{ \Carbon\Carbon::parse($event->end_date)->format('m/d/Y  H:i:s') }}
              </label>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            
              <label for="petrol_saved">{{langMessage('Special Link')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <label class="form-control border-0 rounded-0 primary-text-color py-2 pl-3">
                {{ $event->special_link }}
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            
              <label for="petrol_saved">{{langMessage('QR Code')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
               {!! QrCode::size(100)->generate($event->special_link) !!}
              
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Discription')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <label  class="form-control"> {{ $event->discription}}</label>
         
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Status')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <label class="form-control" >{{ $event->status == 1 ?'Active ':'Inactive'}}
            
          </label>
          
        </div>
        
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">{{langMessage('Image')}}</h3>
            </div>
            <div class="box-body">
              
              <div class="form-group">
               
              <img src="{{asset($event->thumbnail_path)}}" alt="">
              
              </div>
            </div>
          </div>
        </div>
        
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
// $(document).ready(function(){
 
//   $('#end_date').datepicker();
//   $('.select2').select2();
//   $('.textarea').wysihtml5();


//   var up_result = new Date($('#start_date').val());
//   let today = new Date();
//   console.log("dat-",up_result);
//   var up_inc_date = up_result.setDate(up_result.getDate());
//   var increse_date = moment(up_inc_date).format('YYYY-MM-DD');  
//   // $('#start_date').datepicker({ minDate: today, maxDate: "+1M +10D" });
//   $( function() {
//     var dateFormat = "mm/dd/yy",
//       from = $( "#start_date" )
//         .datepicker({
//           defaultDate: "+1w",
//           changeMonth: true,
//           minDate: today,
          
//         })
//         .on( "change", function() {
//           to.datepicker( "option", "minDate", getDate( this ) );
//         }),
//       to = $( "#end_date" ).datepicker({
//         defaultDate: "+1w",
//         changeMonth: true,
//         numberOfMonths: 3
//       })
//       .on( "change", function() {
//         from.datepicker( "option", "maxDate", getDate( this ) );
//       });
 
//       function getDate( element ) {
//         var date;
//         try {
//           date = $.datepicker.parseDate( dateFormat, element.value );
//         } catch( error ) {
//           date = null;
//         }
  
//         return date;
//       }
//   } );

//   // $("#start_date").attr({
//   //       "min" : increse_date,
//   //       //"value" : increse_date,         // values (or variables) here
//   // });
//   $(".disableEndTime").attr('disabled',true);
//   $('body').on('change','#start_date',function(){

//     var result = new Date($(this).val());

//     console.log("dat re-",result);
//     var increse_date = result.setDate(result.getDate() + 1 );
//     var end_date = moment(increse_date).format('YYYY-MM-DD');  
//     $('#end_date').datepicker({ minDate: result, maxDate: "+1M +10D" });

//     // $("#end_date").attr({
//     //       "min" : end_date,
//     //       //"disabled" : false,
//     //       //"value" : increse_date,         // values (or variables) here
//     // });
//     $(".disableEndTime").attr('disabled',false);
//   });

// });
  
</script>
@stop
