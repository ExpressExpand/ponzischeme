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
	<div class="row">
		<div class="col-sm-12">
			<h2 class="custom_head"><span class="border_half"></span> Terms & Conditions</h2>
			<p>
				Easypay Worldwide (EW) is an international community of members. Members help each other by providing help by transferring money directly to one another. It is a peer-to-peer platform . For example, 
				Member A can decide to provide help to member B by paying money into member B account. Member B receives
				 the money and confirms payment. Member B can then decide to provide help to Member C and so on. </p> 
				 <p>There is no formal organization, no legal attorney, and of course no central bank account in Easypay Worldwide. There is no other form of activity, special registration, permission and liecenses in here. Easypay Worldwide is absolutely legal.</p>
				 <p>However, It is worth noting that this is not an Online business, HYIP, investment, Loan or MLM program. It is also not a get rich scheme. Participants are therefore advised to use money they can afford to lose. Members should not be greedy. There are risk involved but however, We will try our best to minimize losses and ensure we have a long lasting system. We implore every member to be honest with each other</p>

				<p> <strong> NOTE:</strong> This Platform has been designed to last forever, with the innovative features implemented to ensure that Participants remain active. All inactive accounts are BLOCKED if after 3days of receiving Help a Participant didn’t place a New Pledge to Provide Help. We have done our Part to give you the Best Platform in the World; it’s in your hands to keep it growing. </p>
			</p>
		</div>
	</div>
</div>
<div class="container-fluid " id="contact">
	<div class="row">
		<div class="col-sm-12 text-center">
			<h2 class="custom_head"><span class="border_half"></span> CONTACT US</h2>
			<p>Please Send us an email to support@easypayworldwide.com for further enquiries.</p>
		</div>
	</div>
</div>
@include('partials/home/_footer')