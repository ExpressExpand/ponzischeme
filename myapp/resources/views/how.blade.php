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
			<h2 class="custom_head"><span class="border_half"></span> How It Works</h2>

			<p>You make a request to PROVIDE HELP(by clicking PROVIDE HELP) indicating the amount you want which can either be in your local currency or in bitcoin. You then wait for the system to match you. The money provided will start growing from the moment it was entered online at the rate of 30% for your local currency or 50% for bitcoin in 30 days. At this, point your still remains with you. The system then matches you to pay, this is when you finally make payment directly to the person account or make transfer for bitcoin pledges.</p>

			<p>You have access to your account which helps you to monitor and track the date a pledge was made, the date and the yield amount. If you pledge lets say 1000 in bitcoin, you will get 50% in 30days. This means in 30 days you will make 500 + 1000 = 1500. While if the same pledge was made in your local currency, this will amount to 300 + 1000 = 1300.</p>

			<p>Once your pledge is fully matured, the system notifies you. You can then make a request to GET HELP. The system matches you immediately as soon as a match is found. This is an automated process. Once a payment is received, it is expected of such participant to confirm payments. If there is any delay, in confirmation of received payments, the system will automatically confirm the payment. However, you can also decide to flag a fake transaction as FAKE POP once you detect the donor uploaded a fake proof of payment(fake POP). The system will automatically block the account of the donor that uploaded a fake proof of payment and will rematch you with another member to pay you.</p>

			<p>Particpants who fail to make payments after pledging will automatically be blocked. As long as you have not been matched to make payment, the request can be cancelled at any point in time.</p>

	<h3>REGISTRATION BONUS</h3>
	<p>When registering in the system, you get from $20 to $100 as a One Time Registration Bonus in Bitcoin and 5,000 to 32,000 as One Time Registration Bonus in Your Local Currency. Bonuses are given only once, not every time. Registration Bonus for Bitcoin pledges are as Follows; </p>

	(1.) $20 Registration Bonus — if you have contributed from $50 to $499. <br />
	(2.) $50 Registration Bonus — if you have contributed from $500 to $2, 000. <br/>
	(3.) $100 Registration Bonus — if you have contributed from $2, 000 and above. <br />

	<p>Registration Bonus for Local Currencies are as Follows;</p>

	(1.) 5,000 Registration Bonus — if you have contributed from 16,000 to 160,000.<br />
	(2.) 10,000 Registration Bonus — if you have contributed from 160,000 to 500,000. <br />
	(3.) 20,000 Registration Bonus — if you have contributed from 500,000 and above of your Local Currency.<br>

	<p>Each participant is allowed to have ONLY one account.</p>
	<h3>Point Score Index</h3>
	<p>The point score index is a logical rating implemented into the system to ensure fair-play and honesty. Each new account is started with 100% rating. Point will be deducted for any violation or awarded for abiding with our terms.</p> 
	
	<h3>Key Guidelines / Penalties include the following </h3>
	<p>If you are paired and you contact the money-receiving member, asking for a 24hr time extension to make payment, once he/she approves in his account, you will lose 25% of your point score.</p>
	
	<p>If you fail to provide help to a paired member and expiry date elapses, your Point Score will be wiped out to Zero (0), which leads to a blocked account. This means you will not be able to provide or get help from this platform. You will have to contact the admin by sending an email to support@easypayworldwide.com.</p>

	<h3>REFERRAL BONUS</h3>
	<p>You get 10% from all deposits of the participant you invited. Inviting new members into the Community is your additional contribution to its development which is not compulsory. You wont be penalized for this. You will earn point for this as well aside your 10% referral bonus you will continue to get as long as your referrals keep providing help.</p>

	<h3>GUIDERS/SPONSORS</h3>
	<p>There are NO Guiders/Sponsors in this Platform. This platform has been DESIGNED TO LAST FOREVER and therefore does not support the excess payout privileges of Guiders which drains the system.</p> 

	<h3>RECOMMITMENT</h3>
	<p>We implore all participants to make recommitment after getting help to help build a sustainable community. Easypay worldwide is designed to ensure we have a long lasting platform. This is different from other schemes that make participants suffer and placing limits on the money. We will do our best to put smiles on everyone faces.</p>

	<p>a.) After receiving Help, a Participant is given a maximum of 3days to make another Pledge to Provide Help. If no new pledge is made after 3 days from receiving help, your points will drop to 0 points and your account will be blocked. We need people that will make this community last forever.</p>
	<p>b.) When a Participant makes a Pledge to Provide Help of $100 for Example; his/her next Pledge to Provide Help will not go below the Previous Help provided. It can only be the same or higher. This will keep the Community Growing instead of being setback by people who will give help of $1,000 for example and after Getting Help of $1,500 they decide to Provide Help of $10 in their next Pledge. This wont work on Easypay worldwide.</p>
				
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