@extends('layouts/master')
@section('title', 'Registration')

@section('content')       
    @include('partials/_alert')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>This is main title</h2>
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
                    @include('partials/_alert')
                    {{ Form::open('') }}
                        <p>Provide Help.</p>
                        <div class="alert alert-info">Note: Current Bitcoin Exchange Rate : 1 USD = 0.00081760 BTC</div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="paymentType">Payment Type 
                            <span class="error">*</span>:</label>
                            <div class="col-lg-10">
                                {{ Form::select('paymentType', getPaymentType(), null, 
                                ['placeholder' => 'Select', 'class' => 'form-control', 'required']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="promoCode">Promo Code:</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="promoCode" class="form-control">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-2 control-label" for="amount">Amount <span class="error">*</span>:</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="amount" class="form-control" required="required">
                                <span class="help-block m-b-none">Amount in multiples of 10 E.g 20000.</span>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-primary" type="submit">
                                <i class="fa fa-paper-plane"></i> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>        
@stop
@section('resources')
@stop