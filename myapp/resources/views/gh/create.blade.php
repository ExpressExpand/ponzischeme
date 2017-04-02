@extends('layouts/master')
@section('title', 'Receive help')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Get Help</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Get help</a>
                </li>
                <li class="active">
                    <strong>Request Payment</strong>
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
            <div class="col-sm-12">
                <div class="ibox-content">
                   @include('partials/_alert')
                    <div class="alert alert-info">
                        The table below shows all your matured collections available to your account. 
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>MATURE DATE</th>
                        <th>PH AMOUNT</th>
                        <th>YIELD AMOUNT</th>
                        <th>BONUSES</th>
                        <th>REQUEST AMOUNT</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 0; ?>
                    @if(count($collections) > 0)
                        
                    @endif
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>MATURE DATE</th>
                        <th>PH AMOUNT</th>
                        <th>YIELD AMOUNT</th>
                        <th>BONUSES</th>
                        <th>REQUEST AMOUNT</th>
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
<script src="{{ asset('js/plugins/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables/dataTables.responsive.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables/dataTables.tableTools.min.js') }}"></script>
@stop