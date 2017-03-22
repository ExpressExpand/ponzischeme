@extends('layouts/master')
@section('title', 'Receive help')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-6">
            <h2>PROVIDE HELP CONFIRMATION</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('dashboard') }}">Dashboard</a>
                </li>
                <li class="">
                    Provide Help
                </li>
                <li class="active">
                    <strong>Confirmation</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-6">
            <div class="title-action">
                <!-- <a href="#" class="btn btn-primary">This is action area</a> -->
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-content">
                    @include('partials/_alert')
                    <div class="alert alert-info">
                        The records below shows your Matched Phs. Please ensure you confirm your payments here
                        and upload a valid proof of payment. Also, Contact the recipient to confirm as well.
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>MATCH DATE</th>
                        <th>PENALTY DATE</th>
                        <th>AMOUNT</th>
                        <th>RECIPIENT</th>
                        <th>PAYMENT DETAILS</th>
                        <th>ACTION</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($donations) > 0)
                        
                    @endif
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>MATCH DATE</th>
                        <th>PENALTY DATE</th>
                        <th>AMOUNT</th>
                        <th>RECIPIENT</th>
                        <th>PAYMENT DETAILS</th>
                        <th>ACTION</th>
                        <th>STATUS</th>
                    </tr>
                    </tfoot>
                    </table>

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