@extends('layouts/master')
@section('title', 'Receive help')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>All Payments</h2>
            <div>This shows all Payments/Pairing made in the system either successful or cancelled</div>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">This is</a>
                </li>
                <li class="active">
                    <strong>Breadcrumb</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="#" class="btn btn-primary">This is action area</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-content">
                    <h4>THE LIST BELOW PROVIDES CONTACT DETAILS OF EVERYONE YOU HAVE EVER BEEN MATCHED TO 
                    PROVIDE HELP TO.</h4>
                    @include('partials/_alert')
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>TRANS ID</th>
                        <th>Amount</th>
                        <th>MATCHED DATE</th>
                        <th>BENEFICIARY</th>
                        <th>ACCOUNT DETAILS</th>
                        <th>ATTACHMENTS</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                   
                        <tr>
                            <th colspan="8"><center>No Data Available</center></th>
                        </tr>
                    <?php endif; ?>
                    
                    </tbody>
                    <tfoot>
                    <tr>
                       <th>TRANS ID</th>
                        <th>Amount</th>
                        <th>MATCHED DATE</th>
                        <th>BENEFICIARY</th>
                        <th>ACCOUNT DETAILS</th>
                        <th>ATTACHMENTS</th>
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