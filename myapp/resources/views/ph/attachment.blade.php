@extends('layouts/master')
@section('title', 'Attachments')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-6">
            <h2>PROVIDE HELP Attachment</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('dashboard') }}">Dashboard</a>
                </li>
                <li class="">
                    Provide Help
                </li>
                <li class="active">
                    <strong>Attachment</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-6">
            <div class="title-action">
                <a href="{{ url('ph/make/payments') }}" class="btn btn-primary">Go Back</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-content">
                    @include('partials/_alert')
                    
                    <div class="row">
                        <div class="col-sm-offset-4 col-sm-4"><center>
                        <img src="{{ asset('images/proofs/'.$transaction->fileHash) }}" 
                        width="100%" height="auto" class="img img-responsive">
                        </center>
                    </div>
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

<script>
    $(document).ready(function() {
        $('.dataTables-example').dataTable({
            responsive: true,
        });
    });
</script>
@stop