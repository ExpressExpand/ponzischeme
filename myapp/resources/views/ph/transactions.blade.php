@extends('layouts/master')
@section('title', 'Receive help')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>PROVIDE HELP (PENDING)</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    Provide Help
                </li>
                <li class="active">
                    <strong>Pending PH</strong>
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
                    <div class="alert alert-info">The records below shows all the  provide help request you have placed via the portal and gives real time status of each. Manage All your Pending Ph here.
                     You can also decide to cancel any of your pending ph orders if you wish.</div>
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>RECORD ID</th>
                        <th>AMOUNT OFFERED</th>
                        <th>PAID AMOUNT</th>
                        <th>OUTSTANDING</th>
                        <th>DATE</th>
                        <th>POINTS</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($donations) > 0)
                        @foreach($donations as $donation)  
                        <tr class="gradeX">    
                            <td>{{ $donation->recordID }}</td>
                            <td>{{ number_format($donation->amount) }}</td>
                            <td>
                                <!-- //check if the user has transactions and add the paid transactions -->
                                <?php $paid_amount = 0; ?>
                                @foreach($donation->transactions as $transaction) 
                                    @if($transaction->fakePOP == 0 && $transaction->receiverConfirmed == 1)
                                        $amount += $transaction->amount
                                    @endif 
                                @endforeach
                                {{ number_format($paid_amount) }}
                            </td>
                            <td>{{ number_format($donation->amount - $paid_amount) }}</td>
                            <td>{{ $donation->created_at }}</td>
                            <td>{{ $donation->points }}</td>

                            <td>
                            @if(strtolower($donation->status) == App\DonationHelp::$SLIP_CONFIRMED)
                                <label class=""><a href="{{ url('ph/show/transaction', $donation->id) }}"> 
                                    {{ $donation->status }} Click here for details</a></label>
                            @elseif(strtolower($donation->status) == App\DonationHelp::$SLIP_PENDING) 
                                {{ $donation->status }} <label class="label label-warning">
                                <a href="{{ url('ph/cancel', $donation->id) }}"> 
                                      Cancel PH</a></label>
                            @else
                                {{$donation->status}}
                            @endif


                            </td>
                        </tr>
                        @endforeach
                    @endif
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>RECORD ID</th>
                        <th>AMOUNT OFFERED</th>
                        <th>PAID AMOUNT</th>
                        <th>OUTSTANDING</th>
                        <th>DATE</th>
                        <th>POINTS</th>
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