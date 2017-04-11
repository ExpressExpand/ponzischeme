@extends('layouts/master')
@section('title', 'Registration')

@section('content')       
    @include('partials/_alert')
    <div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pending Provide Help Orders</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        @if(count($donations) > 0)
                        <div class="ibox-content">
                            <table class="table table-hover no-margins">
                                <thead>
                                <tr>
                                    <th>AMOUNT</th>
                                    <th>RECIPIENT</th>
                                    <th>MATCH DATE</th>
                                    <th>PENALTY DATE</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($donations as $donation)
                                @foreach($donation->transactions as $transaction)
                                    @if($transaction->receiverConfirmed == 1)
                                        <?php continue; ?>
                                    @endif
                                <tr>                     
                                    <td>{{ number_format($transaction->amount, 2) }}</td>
                                    <td><small>{{ $transaction->collection->user->name }}</small></td>
                                    <td class="text-navy"><i class="fa fa-clock-o"></i> {{ $transaction->matchDate }}</td>
                                    <td class="text-navy">
                                        <i class="fa fa-clock-o"></i> {{ $transaction->penaltyDate }}</td>
                                </tr>
                                @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pending Get Help Request</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        @if(count($collections) > 0)
                        <div class="ibox-content">
                            <table class="table table-hover no-margins">
                                <thead>
                                <tr>
                                    <th>AMOUNT</th>
                                    <th>PAID BY</th>
                                    <th>MATCHED DATE</th>
                                    <th>STATUS</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($collections as $collection) 
                                @foreach($collection->ghtransactions as $transaction)
                                    @if($transaction->receiverConfirmed == 1)
                                        <?php continue; ?>
                                    @endif
                                <tr>                     
                                    <td>{{ number_format($transaction->amount, 2) }}</td>
                                    <td><small>{{ $transaction->donation->user->name }}</small></td>
                                    <td class="text-navy"><i class="fa fa-clock-o"></i>
                                     {{ $transaction->matchDate }}</td>
                                     <td>
                                        @if($transaction->payerConfirmed == 1)
                                            <span class="badge badge-info">Paid</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                     </td>
                                </tr>
                                @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
        </div> 
    </div> <!-- end of row -->
    </div> <!-- end of container -->
@stop
@section('resources')
@stop