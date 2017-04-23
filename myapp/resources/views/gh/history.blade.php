@extends('layouts/master')
@section('title', 'Get help payment history')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-6">
            <h2>GET HELP HISTORY</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('dashboard') }}">Dashboard</a>
                </li>
                <li class="">
                    Get Help
                </li>
                <li class="active">
                    <strong>History</strong>
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
                        The records below shows all payments you have ever received on the platform.
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>PAYMENT DATE</th>
                        <th>GET HELP AMOUNT</th>
                        <th>AMOUNT RECEIVED</th>
                        <th>TYPE</th>
                        <th>PAID BY</th>
                        <th>PROOF</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 0; ?>
                    @if(count($collections) > 0)
                        @foreach($collections as $history)
                        @foreach($history->ghtransactions as $transaction)
                            @if($transaction->receiverConfirmed == 1)

                            <tr>
                                <td>{{ ++$counter }}</td>
                                <td>{{ date('M d, Y h:i:sa', strtotime($transaction->updated_at)) }}</td>
                                <td>{{ number_format($history->amount, 2) }}</td>
                                <td> {{ number_format($transaction->amount, 2) }} </td>
                                <td> {{ $history->paymentType }} </td>
                                <td> {{ $transaction->donation->user->name }} </td>
                                <td><a href="{{ url('view/gh/attachment', $transaction->id) }}" 
                                        class="label label-success"> View Attachment</a></td>
                            </tr>
                            @endif
                        @endforeach
                        @endforeach
                    @endif
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>PAYMENT DATE</th>
                        <th>GET HELP AMOUNT</th>
                        <th>AMOUNT RECEIVED</th>
                        <th>TYPE</th>
                        <th>PAID BY</th>
                        <th>PROOF</th>
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