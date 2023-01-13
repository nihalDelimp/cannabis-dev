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
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Name')}}" required data-parsley-required-message="Enter your name">
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
                                        <input type="text" name="start_date" id="start_date" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Start Date')}}" required data-parsley-required-message="Enter your Start Date">
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
                                            @for ($i = 1; $i <= 12; $i++)
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
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="petrol_saved">{{langMessage('Description')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
                                <textarea name="discription" rows="8" cols="80" class="form-control textarea border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="@lang('Enter your description')"></textarea>
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
                                    <select class="form-control" name="status" >
                                        <option value=1>{{langMessage('Active')}}</option>
                                        <option value=0>{{langMessage('Inactive')}}</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger" role="alert">
                                    <strong>{{langMessage($message)}}</strong>
                                    </span>
                                    @enderror
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
                                        <input type="file" name="image_path" class="form-control" required data-parsley-required-message="Upload Image file">
                                        @error('image_path')
                                        <span class="text-danger" role="alert">
                                        <strong>{{langMessage($message)}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-header">
                                    <h3 class="box-title">{{langMessage('Privacy Policy')}}</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <textarea name="privacy_policy" rows="8" cols="80" class="form-control textarea border-0 rounded-0 primary-text-color py-2 pl-3">@include('admin.events.privacy-policy')</textarea>
                                        @error('privacy_policy')
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
<script src="{{asset('plugins/parsley/parsley.min.js')}}"></script> 
<script>

    $('#createForm').parsley({

    });

    $('.select2').select2({

        createTag: function (params) {

            const value = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
            console.log(value.test(params.term))

            if (value.test(params.term) === false) {
                return;
            }


            return {
                id: params.term,
                text: params.term
            }
        },
        tags: true,
        minimumInputLength: 2,
        tokenSeparators: [',']
    });

    $(document).ready(function () {
        $('#end_date').datepicker();

        $('.textarea').wysihtml5();

        $(".disableEndTime").attr('disabled', true);
        let today = new Date();
        $(function () {
            var dateFormat = "mm/dd/yy",
                from = $("#start_date")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    minDate: today,

                })
                .on("change", function () {
                    to.datepicker("option", "minDate", getDate(this));
                }),
                to = $("#end_date").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3
                })
                .on("change", function () {
                    from.datepicker("option", "maxDate", getDate(this));
                });

            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }

                return date;
            }
        });
        $('body').on('change', '#start_date', function () {

            var result = new Date($(this).val());

            console.log("dat re-", result);
            var increse_date = result.setDate(result.getDate() + 1);
            var end_date = moment(increse_date).format('YYYY-MM-DD');
            $(".disableEndTime").attr('disabled', false);
        });


    });
    $(document).ready(function () {
        $('#createForm').on('submit', function (e) {
            //alert("hdljflksdf");
            $('#addSave').prop('disabled', true);
            // $(e.originalEvent.submitter).prop('disabled', true);
            $('#addSave').attr('value', 'Please wait...');
        });
    });
</script>
@stop