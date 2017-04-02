@extends('layouts/master')
@section('title', 'Provide help')

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
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 0; ?>
                    @if(count($donations) > 0)
                        @foreach($donations as $donation)
                        @foreach($donation->transactions as $transaction)
                            @if($transaction->receiverConfirmed == 1)
                                <?php continue; ?>
                            @endif
                            <tr>
                                <td>{{ ++$counter }}</td>
                                <td>{{ $transaction->matchDate }}</td>
                                <td>{{ $transaction->penaltyDate }}</td>
                                <td>{{ number_format($transaction->amount,2) }}</td>
                                <td>{{ $transaction->collection->user->name }}</td>
                                <td>
                                    @if(strtolower($donation->paymentType) == 'bank')
                                        <p><strong>Acc Name:</strong> {{ $transaction->collection->user->name }}</p>
                                        <p><strong>Acc Number:</strong>
                                         {{ $transaction->collection->user->accountNumber }}</p>
                                        <p><strong>Bank:</strong> {{ $transaction->collection->user->bankName }}</p>
                                    @else
                                        <p><strong>Bitcoin: </strong>
                                         {{ $transaction->collectin->user->bitcoinAddress }}</p>
                                    @endif
                                    <p><strong><i class="fa fa-phone"></i></strong> 
                                    {{ $transaction->collection->user->phone }}</p>
                                     <p><strong><i class="fa fa-envelope"></i></strong> 
                                    {{ $transaction->collection->user->email }}</p>
                                </td>
                                <td>
                                    @if($transaction->payerConfirmed == 0)
                                        <a href="{{ url('confirm/ph/payment', $transaction->id) }}"
                                         class="label label-info">
                                        Confirm Payment</a>
                                    @else
                                        <div>
                                            <span class="pie">50/100</span>
                                        </div>
                                        <a href="{{ url('view/attachment', $transaction->id) }}" 
                                        class="label label-success">
                                        View Attachment</a>
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
<script src="{!! asset('js/inspinia/plugins/peity/jquery.peity.min.js') !!}"></script>
<script>
    $(function() {
        $("span.pie").peity("pie", {
            fill: ['#1ab394', '#d7d7d7', '#ffffff']
        })
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