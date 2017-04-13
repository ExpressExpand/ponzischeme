<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>GiveAndGet</title>
    <link rel="stylesheet" href="style.css">
	<link href="{{ asset('css/inspinia/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	@font-face {
    font-family: OpenSans-Italic;
    src: url('/css/open-sans/OpenSans-Italic.ttf');
	}
	@font-face {
	    font-family: Montserrat;
	    src: url('/css/montserrat/Montserrat-Regular.ttf');
	}
	body {
		font: 14px "Montserrat", "open sans", sans-serif;
		color: #676a6c;
		/*heigh: 100%*/
		/*width*/
	}
	.container-fluid {
	    padding-top: 70px;
	    padding-bottom: 70px;
	}
	#background-image{
		background: url("/images/app/home_wallpaper.jpg") no-repeat center center fixed;
		background-size: cover;
		height: 550px;
	}
	.bg-grey{
		background-color: #f6f6f6;
	}
	.container-fluid {
		padding: 60px 50px;
	}
	/*navbar style starts here*/
	.navbar {
	    margin-bottom: 0;
	    background-color: #ffffff;
	    z-index: 9999;
	    border: 0;
	    padding: 5px 0px;
	    letter-spacing: 4px;
	    border-radius: 0;
	}
	/*.navbar li a, .navbar .navbar-brand {
	    color: #fff !important;
	}*/
	.navbar-nav li a:hover, .navbar-nav li.active a {
	    color: #5cb85c !important;
	    background-color: #fff;
	}
	.navbar-nav li a:hover{
		border-bottom: 3px solid #5cb85c;
	}
	.navbar-default .navbar-toggle {
	    border-color: transparent;
	    color: #fff !important;
	}
	.btn-register{
		background-color: #5cb85c; /*green*/
		border: 1px solid #5cb85c;
		border-radius: 5px;
		color: #fff !important;
		padding-left: 14px;
		padding-right: 14px;
		padding-top:7px !important;
		padding-bottom:7px !important;
		margin-top: 5px;
	}
	.btn-register:hover{
		border:1px solid #5cb85c !important;
		background-color: #fff;
		color: #5cb85c;
	}
	.btn-login{
		border: 1px solid #5cb85c;
		border-radius: 5px;
		color: #5cb85c;
		padding-left: 14px;
		padding-right: 14px;
		margin-right: 8px;
		padding-top:7px !important;
		padding-bottom:7px !important;
		margin-top: 5px;
	}
	.btn-login:hover{
		background-color: #5cb85c;
		border:none !important;
		color: #ffffff !important;
	}
	.btn-auth {
		box-sizing: border-box;
	    display: block;
	    font-weight: 400;
	}
	.jumbotron {
		padding: 0px;
	}
	.image_wrapper {
		margin-top: 60px !important;
		position: relative
	}
	.image_text {
		top:30%;
		z-index: 100;
		padding-left: 40px;
		position: absolute;
	}
	
	.slideanim {visibility:hidden;}
	.slide {
	    /* The name of the animation */
	    animation-name: slide;
	    -webkit-animation-name: slide; 
	    /* The duration of the animation */
	    animation-duration: 1s; 
	    -webkit-animation-duration: 1s;
	    /* Make the element visible */
	    visibility: visible; 
	}

	/* Go from 0% to 100% opacity (see-through) and specify the percentage from when to slide in the element along the Y-axis */
	@keyframes slide {
	    0% {
	        opacity: 0;
	        transform: translateY(70%);
	    } 
	    100% {
	        opacity: 1;
	        transform: translateY(0%);
	    } 
	}
	@-webkit-keyframes slide {
	    0% {
	        opacity: 0;
	        -webkit-transform: translateY(70%);
	    } 
	    100% {
	        opacity: 1;
	        -webkit-transform: translateY(0%);
	    }
	}
	@media screen and (max-width: 768px) {
	}


	</style>
</head>

<body>
<!-- <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60"> -->

<!-- <div id="about" class="container-fluid">
<div id="services" class="container-fluid">
<div id="portfolio" class="container-fluid">
<div id="pricing" class="container-fluid">
<div id="contact" class="container-fluid"> -->

<nav class="navbar navbar-fixed-top navbar-default">
  	<div class="container">
    	<div class="navbar-header">
	      	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
	      	</button>
	      	<a class="navbar-brand" href="#">Logo</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
		    <ul class="nav navbar-nav navbar-right">
		    	<li><a href="#about">About</a></li>
		    	<li><a href="#how">How It Works</a></li>
		        <li><a href="{{ url('login') }}" class="btn-auth btn-login">Login</a></li>
		        <li><a href="{{ url('register') }}" class="btn-auth btn-register">Register</a></li>
		    </ul>
	    </div>
  	</div>
</nav>
<!-- <div class="container-fluid">
	<div id="background-image">
		
	</div>
</div> -->

<div class="image_wrapper jumbotron">
  	<div id="background-image">
  		<div class="image_text">
			  	<p>Get 30% in 30 days in local currency</p>
			  	<p>Get 50% in 30 days in Bitcoin</p> 
			  	<p>This is a peer-to-peer system</p> 
	  	</div>
  	</div>
</div>
<div class="container-fluid">
</div>
<div class="container-fluid bg-grey">
</div>
    <!-- Mainly scripts -->
    <script src="{{ asset('js/inspinia/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/inspinia/bootstrap.min.js') }}"></script>
    <script>
    	$(window).scroll(function() {
		  $(".slideanim").each(function(){
		    var pos = $(this).offset().top;

		    var winTop = $(window).scrollTop();
		    if (pos < winTop + 600) {
		      $(this).addClass("slide");
		    }
		  });
		});
    </script>
</body>
</html>