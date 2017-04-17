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
<!-- <div class="row register_wrap bg-grey"> -->
    <div class="col-sm-12">
        <div class="form_wrap">
            <h4><i class="fa fa-sign-in"></i> Login.</h4><hr />
            @include('partials/_alert')
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                <div class="form-group">
                    <div class="input-group">  
                        <input id="email" type="text" class="form-control" name="login" placeholder="Email or Phone"
                        required="required">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">  
                        <input id="password" type="password" class="form-control" name="password" placeholder="password"
                         required="required">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    </div>
                </div>
                <div class="form-group text-center">
                    <!-- <div class="g-recaptcha" data-sitekey="6LcboBgUAAAAAKsJrg-3azvWrSJPfJGhXqM4P3AC"></div> -->
                    <span id="captcha">{!! captcha_img('flat') !!} </span>
                    <span id="refresh" class="reload_captcha">
                    <i class="fa fa-refresh"></i></span>

                    <div><br />
                    <p><span class="green"><strong> ENTER CAPTCHA: </strong></span>
                    <input type="text" name="captcha" required=""></p>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary block full-width m-b form-control">Login</button>
                </div>
            </form>
        </div>  
    </div>
</div>
    @include('partials/home/_footer')