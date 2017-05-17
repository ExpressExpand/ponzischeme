@extends('layouts/master')
@section('title', 'Inbox Message')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Inbox Message</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Messages</a>
                </li>
                <li class="active">
                    <strong>Inbox</strong>
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
            @include('partials/_messaging')

            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <form method="get" action="http://webapplayers.com/inspinia_admin-v2.0/index.html" class="pull-right mail-search">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" name="search" placeholder="Search email">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
                <h2>
                    Inbox ({{ $messages->where('readStatus', 0)->count() }})
                </h2>
                {{ Form::open([ 'url' => 'messaging/delete', 'method'=>'delete']) }}
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>

                    </div>
                    <a class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"
                     onclick="window.location.reload();" href="javascript:void(0);">
                     <i class="fa fa-refresh"></i> Refresh</a>
                    <!-- <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> </button> -->
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>

                </div>
            </div>
                <div class="mail-box">

                <table class="table table-hover table-mail">
                <tbody>
                @foreach($messages as $transaction) 
                    @if($transaction->readStatus == 0) 
                        <tr class="unread">
                            <td class="check-mail">
                                <input type="checkbox" name="transaction[]" value="{{ $transaction->id }}" class="i-checks">
                            </td>
                            <td class="mail-ontact"><a href="{{ url('messaging/detail'
                            , $transaction->id) }}">
                                Admin</a></td>
                            <td class="mail-subject"><a href="{{ url('messaging/detail'
                        , $transaction->id) }}">
                                {{ $transaction->message->subject }}
                            </a></td>
                            <td class=""><!-- <i class="fa fa-paperclip"></i> --></td>
                            <td class="text-right mail-date">
                                {{ $transaction->created_at->diffForHumans() }}</td>
                        </tr>
                    @elseif($transaction->readStatus == 1)
                        <tr class="read">
                            <td class="check-mail">
                                <input type="checkbox" name="transaction[]" value="{{ $transaction->id }}" class="i-checks">
                            </td>
                            <td class="mail-ontact"><a href="{{ url('messaging/detail'
                            , $transaction->id) }}">
                                Admin</a></td>
                            <td class="mail-subject"><a href="{{ url('messaging/detail'
                            , $transaction->id) }}">
                                {{ $transaction->message->subject }}
                            </a></td>
                            <td class=""><!-- <i class="fa fa-paperclip"></i> --></td>
                            <td class="text-right mail-date">
                                {{ $transaction->created_at->diffForHumans() }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
                </table>
                <div class="paginate">{{ $messages->render() }} </div>

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

<script>
    $(document).ready(function() {
        $('.dataTables-example').dataTable({
            responsive: true,
        });
    });
</script>
@stop