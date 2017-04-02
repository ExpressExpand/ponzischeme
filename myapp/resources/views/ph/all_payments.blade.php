@extends('layouts/master')
@section('title', 'All payments')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>All Payments</h2>
            <div></div>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">This is</a>
                </li>
                <li class="active">
                    <strong>All Payments</strong>
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
                    <div class="alert alert-info">
                        <h4>This shows all Payments/Pairing made in the system either successful or cancelled</h4>
                    </div>
                    @include('partials/_alert')
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Amount</th>
                        <th>MATCHED DATE</th>
                        <th>BENEFICIARY</th>
                        <th>ACCOUNT DETAILS</th>
                        <th>ATTACHMENTS</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 0; ?>
                    @if($donations)
                    @foreach($donations as $donation)
                    @foreach($donation->transactions as $transaction)
                        <tr>
                            <td>{{ ++$counter }}</td>
                            <td>{{ number_format($transaction->amount, 2) }}</td>
                            <td>{{ date('d-m-Y', strtotime($transaction->updated_at)) }}</td>
                            <td>{{ $transaction->collection->user->name }}</td>
                            <td>
                                @if(strtolower($donation->paymentType) == 'bank')
                                    <p><strong>Acc Name:</strong> {{ $transaction->collection->user->name }}</p>
                                    <p><strong>Acc Number:</strong>
                                     {{ $transaction->collection->user->accountNumber }}</p>
                                    <p><strong>Bank:</strong> {{ $transaction->collection->user->bankName }}</p>
                                @else
                                    <p><strong>Bitcoin: </strong>
                                     {{ $transaction->collection->user->bitcoinAddress }}</p>
                                @endif
                                <p><strong><i class="fa fa-phone"></i></strong> 
                                {{ $transaction->collection->user->phone }}</p>
                                 <p><strong><i class="fa fa-envelope"></i></strong> 
                                {{ $transaction->collection->user->email }}</p>
                            </td>
                            <td>
                                 <a href="{{ url('view/attachment', $transaction->id) }}" 
                                        class="label label-success">
                                        View Attachment</a>
                            </td>
                            <td>
                                @if(strtolower($transaction->donation->status) == App\DonationHelp::$SLIP_CONFIRMED)
                                    <div>
                                        <span class="label label-info">Completed</span>
                                    </div>
                                @else
                                    <span class="label label-danger"> 
                                    {{ $transaction->donation->status }}</span>
                                @endif
                            </td>
                        </tr>

                    @endforeach
                    @endforeach
                    @else
                        <tr>
                            <th colspan="8"><center>No Data Available</center></th>
                        </tr>
                    @endif
                    
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
                    <div class="paginate">{{ $donations->render() }}</div>
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