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
@stop
@section('resources')
@stop