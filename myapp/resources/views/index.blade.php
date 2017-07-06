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
		    	<li><a href="#how">How It Works</a></li>
		    	<li><a href="#about">About</a></li>
		    	<li><a href="#faq">Faq</a></li>
		    	<li><a href="#contact">Contact</a></li>
		        <li><a href="{{ url('login') }}" class="btn-auth btn-login">Login</a></li>
		        <li><a href="{{ url('register') }}" class="btn-auth btn-register">Register</a></li>
		    </ul>
	    </div>
  	</div>
</nav>
<div class="image_wrapper jumbotron">
  	<div id="background-image">
  		<div class="image_text">
  			<h1>EASYPAY WORLDWIDE</h1>
		  	<h2 class="colora">Get 30% in 30 days in local currency</h2>
		  	<h2 class="colorb">Get 50% in 30 days in Bitcoin</h2> 
		  	<h2 class="colorc">Peer-to-peer donations</h2> 
		  	<a class="custom_btn wallpaper_btn">Start with a little</a>
	  	</div>
	  	<div class="image_textb">
	  		
	  		<!-- <h3>WE RISE BY HELPING OTHERS</h3> -->
	  		
	  	</div>
  	</div>
</div>
<div class="container-fluid bg-grey how_margin" id="how">
	<div class="row row-one">
		<h2 class="text-center custom_head"><span class="border_half"></span>HOW IT WORKS</h2>
		<h4 class="text-center">For more details, <a href="{{ url('how') }}"> click here</a></h4>
		<div class="col-sm-3 text-center">
			<img src="{{asset('images/app/package.png') }}" width="64px" height="auto" alt="easypay icon">
			<p>Register free to become a member.
			Make a request to "PROVIDE HELP" with any amount you will like to donate. 
			</p>
		</div>
		<div class="col-sm-3 text-center">
			<img src="{{asset('images/app/network.png') }}" width="64px" height="auto" alt="easypay icon">
			<p>The system automatically matches you with another member.
			Proceed to make payment either in bitcoin or local currency.</p>
		</div>
		<div class="col-sm-3 text-center">
			<img src="{{asset('images/app/open-box.png') }}" width="64px" height="auto" alt="easypay icon">
			<p>After 30 days, You will GET HELP Of <strong>30%</strong> of the amount you donated plus your initial deposit. </p>
		</div>
		<div class="col-sm-3 text-center">
			<img src="{{asset('images/app/package.png') }}" width="64px" height="auto" alt="easypay icon">
			<p>You will also be entitled to 10% registration bonus as a first timer for any amount you provide. Aside this, you can also earn bonuses from referrals.</p>
		</div>
	</div>
</div>
<div class="container-fluid clearfix" id="about">
	<div class="row">
		<div class="col-sm-6">
		<img src="{{asset('images/app/money_exchange.jpg') }}" width="100%" height="auto" alt="easypay icon">
		</div>
		<div class="col-sm-6">
			<h2 class="custom_head"><span class="border_half"></span> What is EasyPay Worldwide?</h2>
			<p>Easypay worldwide is an international community of donors. Easypay world wide is a peer-to-peer donation 
			platform for members to help other members in a systematic way. This means, there is no central account. We only help to regulate the system. Nothing more. Money only flows between members. By using this platform, Members can Provide Help and also Get Help. It is open to everybody</p>
		</div>
	</div>
</div>
<div class="container-fluid bg-grey" id="faq">
	<h2 class="text-center custom_head"><span class="border_half"></span> FAQ</h2>
	<div class="row">
		<div class="col-sm-6">
			<p>EasyPay worldwide is not a bank. we are not an Online business, HYIP, investment, Loan or MLM program. 
			Easypay is a community where people help each other. It is a peer-to-peer system.</p>
			<h3>What is the minimum amount I can donate?</h3>
			<p>The minimum amount if you provide help in bitcoin is 10 USD and in your local currency is N1000.
			</p>
			<h3>What happens if the person I am matched with refuses to pay.</h3>
			<p>First of all, we encourage participants to be honest with each other. The system will automatically rematch you another member to pay you while the person will be blocked. This is a measure taken to ensure there is transparency in the system.</p>
		</div>
		<div class="col-sm-6">
			<h3>How Much do I get after 30 days?</h3>
			<p>Lets say you provide help of 100 USD. After 30 days, you will earn 30% of your donation plus your donation amount. That is 30 USD + 100 USD = 130 USD</p>

			<h3>Are there Guiders?</h3>
			<p>There are no guiders in the system. We try as much as possible to ensure there are no loop holes in the system.</p>
			<h3>What are the bonuses</h3>
			<p>You get registration bonus as a first timer. Below is the breakdown: 
			<ul>
				<li>You get N5,000 bonus for amount above 16,000 and less than	 160,000. </li>
				<li>You get N10,000  for amount above 160,000 and less than 500,000.</li>
				<li>You get 32,000 for amount above 500,000.</li>
			</ul>
			
			<p>You will also continue to earn 10% of any amount provided by your referrals.</p>
		</div>
	</div>
</div>
<div class="container-fluid bg_blue" id="contact">
	<div class="row">
		<div class="col-sm-12 text-center">
			<h2 class="custom_head"><span class="border_half"></span> CONTACT US</h2>
			<p>Please Send us an email to support@easypayworldwide.com. or a message when you log in</p>
			<span><a href="{{ url('login') }}" class="btn btn-login">Login</a></span>
		    <span><a href="{{ url('register') }}" class="btn btn-register">Register</a></span>
		</div>
	</div>
</div>
@include('partials/home/_footer')