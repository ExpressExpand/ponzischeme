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
                        The records below shows your active get help request. Please ensure you have received  your alert before clicking confirm. Once clicked, it cannot be reversed.
                    </div>

                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>MATCH DATE</th>
                        <th>EXPIRY DATE</th>
                        <th>AMOUNT</th>
                        <th>PAID BY</th>
                        <th>PAYMENT TYPE</th>
                        <th>ACTION</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 0; ?>
                    @if(count($collections) > 0) 
                        @foreach($collections as $collection)
                        @foreach($collection->ghtransactions as $transaction)
                            @if($transaction->receiverConfirmed == 1) 
                                <?php continue; ?>
                            @endif
                            <tr>
                                <td>{{ ++$counter }}</td>
                                <td>{{ $transaction->matchDate }}</td>
                                <td>{{ $transaction->penaltyDate }}</td>
                                <td>{{ number_format($transaction->amount,2) }}</td>
                                <td>{{ $transaction->donation->user->name }}</td>
                                <td>
                                    {{ $collection->paymentType }}
                                </td>
                                <td>
                                    <div>
                                        @if($transaction->fakePOP == 0)
                                            <a href="{{ url('confirm/gh/payment/edit', $transaction->id) }}"
                                                 class="label label-danger">
                                                Confirm Payment</a></div><br />
                                        @endif
                                    @if($transaction->payerConfirmed == 1)
                                        <a href="{{ url('view/gh/attachment', $transaction->id) }}" 
                                        class="label label-success">
                                        View Attachment</a>
                                    @endif
                                </td>
                                <td>
                                    @if($transaction->payerConfirmed == 1)
                                        @if($transaction->fakePOP == 1)
                                            <a href="{{ url('flagpop', $transaction->id) }}" id="confirmFakePop">
                                            <span class="label label-danger">Fake POP Resolve in Progress</span></a>
                                        @else
                                            <a href="{{ url('flagpop', $transaction->id) }}" id="confirmFakePop">
                                            <span class="label label-danger">Flag as Fake POP</span></a>
                                        @endif
                                    
                                    @else
                                        <span class="label label-info">In Progress</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @endforeach
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
    $('#confirmFakePop').click(function(e) {
        var result = confirm('Are you sure this transaction is fake. Once discovered as fake, you will be rematched');
        if(!result){
            e.preventDefault();
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.dataTables-example').dataTable({
            responsive: true,
        });
    });
</script>
@stop