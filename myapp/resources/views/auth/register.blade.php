@include('partials/home/_header')
<nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
        <div class="navbar-header"> 
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{asset('images/app/logo.png') }}" width="64px" height="auto" alt="easypay logo">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/') }}">How It Works</a></li>
                <li><a href="{{ url('/') }}">About</a></li>
                <li><a href="{{ url('/') }}">Faq</a></li>
                <li><a href="{{ url('/') }}">Contact</a></li>
                <li><a href="{{ url('login') }}" class="btn-auth btn-login">Login</a></li>
                <li><a href="{{ url('register') }}" class="btn-auth btn-register">Register</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid bg-grey">
    <div class="col-sm-12">
        <div class="form_wrap">
            <h4><i class="fa fa-user"></i> Create an account.</h4><hr />
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
                <div class="form-group text-center"><label>
                By signing up you agree to the <a href="{{ url('terms') }}">terms.</label>
                </div>
                <!-- <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
                </div> -->
                <button type="submit" class="btn btn-primary block full-width m-b form-control">Register</button>
            </form>
        </div>
    </div><!-- end of column -->
</div>
@include('partials/home/_footer')