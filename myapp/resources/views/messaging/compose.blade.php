@extends('layouts/master')
@section('title', 'Compose Message')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Compose Message</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Admin</a>
                </li>
                <li class="">
                    <strong>Messages</strong>
                </li>
                <li class="">
                    <strong>Compose</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <!-- <a href="#" class="btn btn-primary">This is action area</a> -->
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            @include('partials/_alert')
            @include('partials/_messaging')
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <div class="pull-right tooltip-demo">
<!--                     <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a> -->
                    <a href="javascript:void(0);"
                    onclick="window.history.back();" 
                     class="btn btn-danger btn-sm" data-toggle="tooltip"
                      data-placement="top" title="Discard message"><i class="fa fa-times"></i> Discard</a>
                </div>
                <h2>
                    Compose mail
                </h2>
            </div>
                <div class="mail-box">

                {{ Form::open(['class'=> 'form-horizontal', 'method'=> 'post'
                    , 'url'=> 'messaging/send/message']) }}
                <div class="mail-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="subject">Subject:</label>
                        <div class="col-sm-10">
                            <input type="text" name="subject" id="subject"
                             class="form-control" value=""></div>
                    </div>
                </div>

                    <div class="mail-text h-200">
                        <textarea name="body" class="form-control" id="editor"></textarea>
                        <div class="clearfix"></div>
                    </div>
                    <div class="mail-body text-right tooltip-demo">
                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
                         title="Send"><i class="fa fa-envelope"></i> Send</button>
                        <a href="javascript:void(0);" 
                        onclick="window.history.back();" 
                        class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
<!--                         <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a> -->
                    </div>
                    {{ Form::close() }}
                    <div class="clearfix"></div>



                </div>
            </div>
        </div>
    </div>        
@stop
@section('resources')
<!-- Data Tables -->
<script src="{{ asset('js/inspinia/plugins/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/inspinia/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('js/inspinia/plugins/dataTables/dataTables.responsive.js') }}"></script>
<script src="{{ asset('js/inspinia/plugins/dataTables/dataTables.tableTools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.dataTables-example').dataTable({
            responsive: true,
        });
    });
</script>
<script type="text/javascript">
    CKEDITOR.replace( 'editor' );
</script>
@stop