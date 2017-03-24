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
		background: url("") no-repeat center center fixed;
		background-size: cover;
	}

	</style>
</head>
<body>
<nav class="navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">Me</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ url('login') }}" class="btn btn-success">Login</a></li>
        <li><a href="{{ url('register') }}">Register</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
	<div id="background-image">
		
	</div>
</div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/inspinia/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/inspinia/bootstrap.min.js') }}"></script>
</body>
</html>