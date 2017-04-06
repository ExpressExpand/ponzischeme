@extends('layouts/master')
@section('title', 'Registration')

@section('content')       
    @include('partials/_alert')
    <div class="sidebard-panel">
        <div>
            <h4>Inbox Messages <span class="badge badge-info pull-right">{{ $messages->count() }}</span></h4>
            @foreach($messages as $message)
            <div class="feed-element">
                <a href="#" class="pull-left">
                    <img src="{{ asset('images/app/avatar.jpg') }}" 
                    alt="users picture" class="img-circle" width="100%">
                </a>
                <div class="media-body">
                	<p><strong>{{ $message->message->subject }}</strong></p>
                    {!! getExcerpt($message->message->body, 100) !!}
          
                    <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                </div>
            </div>
            @endforeach
            <button class="btn btn-primary btn-sm" style="width:100%">View All</button>
        </div>
        <div class="m-t-md">
            <h4>Real Time Transactions</h4>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.
            </p>
            <div class="row m-t-sm">
                <div class="col-md-6">
                    <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
                    <h5><strong>169</strong> Posts</h5>
                </div>
                <div class="col-md-6">
                    <span class="line">5,3,9,6,5,9,7,3,5,2</span>
                    <h5><strong>28</strong> Orders</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
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
                            <td>{{ number_format($transaction->amount,2) }}</td>
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
                        @if(is_array($collection->ghtransactions))
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
                        @else
                        	 <tr>                     
                            <td>{{ number_format($collection->amount, 2) }}</td>
                            <td><small></small></td>
                            <td class="text-navy"><i class="fa fa-clock-o"></i>
                            	<small> {{ date('d-m-Y h:i:sa', strtotime($collection->created_at))}}
                            	 </small></td>
                             <td>
                                <span class="badge badge-info">{{ $collection->status }}</span>
                             </td>
                        </tr>
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
    	</div>
    </div>
    </div>
@stop
@section('resources')
@stop