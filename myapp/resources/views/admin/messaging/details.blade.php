@extends('layouts/master')
@section('title', 'Display Message')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Display Message</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Admin</a>
                </li>
                <li class="">
                    <strong>Messages</strong>
                </li>
                <li class="">
                    <strong>Details</strong>
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
        @include('partials/_alert')
        <div class="row">
            @include('partials/admin/_messaging')
            
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <a href="mail_compose.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i> Reply</a>
                   <!--  <a href="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Print email"><i class="fa fa-print"></i> </a>
                    <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </a> -->
                </div>
                <h2>
                    Message
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">


                    <h3>
                        <span class="font-noraml">Subject: </span>
                        {!! $message->message->subject !!}
                    </h3>
                    <h5>
                        <span class="pull-right font-noraml">{{ $message->user->created_at->diffForHumans() }}
                        </span>
                        
                        @if($message->messageFlag == 'sent')
                            <span class="font-noraml">To: </span><label class="label label-success"> Users</label>
                        @else
                        <span class="font-noraml">From: </span><label class="label label-success">
                         {{ $sender->user->name }}</label>
                        @endif
                    </h5>
                </div>
            </div>
                <div class="mail-box">


                <div class="mail-body">
                   {!! $message->message->body !!}
                </div>
                   
                        <div class="mail-body text-right tooltip-demo">
                                <a class="btn btn-sm btn-white" href="javascript:void(0);"
                                data-toggle="modal" data-target="#reply-form">
                                <i class="fa fa-reply"></i> Reply</a>
                               <!--  <a class="btn btn-sm btn-white" href="mail_compose.html"><i class="fa fa-arrow-right"></i> Forward</a>
                                <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Print" class="btn btn-sm btn-white"><i class="fa fa-print"></i> Print</button>
                                <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-sm btn-white"><i class="fa fa-trash-o"></i> Remove</button> -->
                        </div>
                        <div class="clearfix"></div>


                </div>
            </div>
        </div>
    </div>     


    <div class="modal inmodal fade" id="reply-form" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {{ Form::open(['class'=> 'form-horizontal', 'method'=> 'post'
                    , 'url'=> 'admin/messaging/reply/message']) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title">Reply {{$sender->user->name}}'s Message</h5>
                </div>
                <div class="modal-body">
                     
                    <div class="mail-text">
                        <textarea name="body" class="form-control" id="editor"></textarea>
                        <div class="clearfix"></div>
                        {{ Form::hidden('recipient_id', $sender->user->id) }}
                        {{ Form::hidden('subject', $message->message->subject) }}
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reply</button>
                </div>
                {{ Form::close() }}
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