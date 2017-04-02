@extends('layouts/master_auth')
@section('title', 'Registration')

@section('content')       
    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">IN+</h1>
            </div>
            <h3>Register to IN+</h3>
            <p>Create account to see it in action.</p>
            @include('partials/_alert')
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}
                <div class="form-group">
                    <div class="input-group">  
                        <input id="fullname" type="text" class="form-control" name="fullname" placeholder="Full name"
                        required="required">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">  
                        <input id="email" type="text" class="form-control" name="email" placeholder="Email" 
                        required="required">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">  
                        <input id="phone" type="text" class="form-control" name="phone" 
                        placeholder="Phone (include country code)" required="required">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">  
                        <input id="password" type="password" class="form-control" name="password" placeholder="password"
                         required="required">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">  
                        <input id="password_confirm" type="password" class="form-control" 
                        name="password_confirm" placeholder="Confirm Password" required="required">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">  
                        <input id="referral_email" type="text" class="form-control" name="referral_email"
                         value="{{ $ref_id }}" placeholder="Referral Email">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::select('relatedCountryID', $countries, null, ['placeholder' => 'Select Country',
                    'class' => 'form-control']) }}
                </div>
                <div class="form-group"><label>
                By clicking on the "register now" button, I fully understand all the risks. I made decision to participate in easypayworldwide.com, being of sound mind and memory.</label></form>
                <!-- <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
                </div> -->
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>
            </form>
        </div>
    </div>
@stop
@section('resources')
@stop