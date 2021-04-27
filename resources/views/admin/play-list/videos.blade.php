@extends('layouts.default')
@section('pagecss')
<style type="text/css">
    #sortable li { cursor:move; }
    #sortable li span { position: absolute; margin-left: -1.3em; }
    #sortable li.fixed{cursor:default; color:#959595; opacity:0.5;}
    .yellow
    {
        background:yellow;
    }
</style>

@stop
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
                   
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 class="box-title">{{langMessage($pageHeading)}}</h3>
                        </div>
                        <div class="col-xs-6">
                            <span id="sorting-msg-bx">
                                
                            </span>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{langMessage($message)}}</p>
                    </div>
                    @endif
                    
                    <ul id="sortable" class="list-group list-group-unbordered">
                        @foreach($videos as $video)
                        <li class="list-group-item" id="item-{{$video->id}}">
                            <div class="post">
                                
                                <div class="row margin-bottom">
                                    <div class="col-sm-5">
                                        <h4>{{$video->title}}</h4> {{$video->sub_title}}
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-5">
                                        <!--<img src="https://img.youtube.com/vi/{{ $video->link_id }}/default.jpg">-->
                                        <img src="{{$video->image_path}}">
                                        <!-- /.row -->
                                    </div>
                                    <div class="col-sm-2">
                                        <!--<button type="button" class="btn btn-warning"><i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></button>-->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                
                            </div>
                        </li>
                        @endforeach
                    </ul>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    
    $('#sortable').sortable({
        axis: 'y',
        update: function (event, ui) {
            var data = $(this).sortable('serialize');
            console.log(data);

            $('#sorting-msg-bx').html('<button type="button" class="btn btn-primary btn-lrg ajax" title="Ajax Request"><i class="fa fa-spin fa-refresh"></i>&nbsp; Processing</button>');
            // POST to server using $.post or $.ajax
            $.ajax({
                data: data,
                type: 'POST',
                url: "{{route('play.list.sort',app()->getLocale())}}",
                success:function(data) {
                    if(!data.error) {
                        $('#sorting-msg-bx').html('<button id="sort-order-success-btn" type="button" class="btn btn-primary btn-lrg ajax" title="Ajax Request"><i class="fa fa-fw fa-check"></i>&nbsp; Reordered</button>');
                        $('#sort-order-success-btn').delay(1000).fadeOut();
                    }
                    console.log(data); 
                }
            });
        }
    });
    
</script>
@stop