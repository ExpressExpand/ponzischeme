@extends('layouts/master')
@section('title', 'Receive help')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-6">
            <h2>GET HELP</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('dashboard') }}">Dashboard</a>
                </li>
                <li class="">
                    Get Help
                </li>
                <li class="active">
                    Confirm
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
                    <div class="alert alert-danger">
                        <h2>WARNING: Are you sure you want to confirm this transaction? 
                        Once Confirmed cannot be 
                        reversed. </h2>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <center>
                            <h1>Yes, I have received an alert of {{ number_format($transaction->amount, 2) }} 
                            in my account.</h1>
                            </h1>
                            <div >
                                <a class="btn btn-success btn large"
                                 href="{{ url('confirm/gh/payment/store', $transaction->id) }}">YES, I CONFIRM
                                </a>
                                <a class="btn btn-danger btn large" href="{{ url('confirm/gh/payment') }}">
                                    NO, GO BACK
                                </a>
                            </div>
                        </div>
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