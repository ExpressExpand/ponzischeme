@extends('layouts/master')
@section('title', 'Confirm Match Payment')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Confirm Matched PH</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('Dashboard') }}">Dashboard</a>
                </li>
                <li class="">
                    <strong>Provide Help</strong>
                </li>
                <li class="active">
                    <strong>Confirm Payment</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
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
                    {{ Form::model($transaction, ['url' => 'confirm/ph/payment/store', 'class'=>'form-horizontal'
                    , 'method'=>'post', 'enctype'=> 'multipart/form-data']) }}
                        <h2>Payment Confirmation.</h2>
                        <div class="alert alert-info">Confirm your payment here. Ensure you upload  a 
                         valid proof of paymet. <p class="error">Your account will be blocked if you upload a 
                         fake proof of payment</p></div>
                         <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

                         <div class="form-group">
                            <label class="col-lg-2 control-label" for="amount">Amount :</label>
                            <div class="col-lg-10">
                                {{ Form::text('amount', null, ['class'=> 'form-control', 'readonly']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="amount">Upload Proof :</label>
                            <div class="col-lg-10">
                                {{ Form::file('attachment', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>


                         <div class="form-group">
                            <label class="col-lg-2 control-label" for="comment">Comment :</label>
                            <div class="col-lg-10">
                                {{ Form::textarea('comment', null, ['class'=> 'form-control'
                                , 'rows' => '3']) }}
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-primary" type="submit">
                                <i class="fa fa-paper-plane"></i> Submit</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>        
@stop
@section('resources')

@stop