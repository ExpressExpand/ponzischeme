<footer class="bg-footer">
	<p class="clearfix"><center>Copyright &copy; 2016. - Easypay Worldwide.</center>
		<a href="#top" title="To Top" class="pull-right arrow_up">
		    <span class="fa fa-arrow-circle-o-up"></span>
		  </a>
	</p>
	<div class="text-center">
		<ul class="footer-links">
			<li><a href="{{ url('login') }}">Login</a></li>
			<li><a href="{{ url('how') }}">How It Works</a></li>
			<li><a href="{{ url('terms') }}">Terms & Condition</a></li>
		</ul>
	</div>
</footer>
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
    <script src='https://www.google.com/recaptcha/api.js'></script>
	<script>
	    $('.reload_captcha').click(function() {
	        $.ajax({
	            url: '/captcha/post/code/',
	            type: 'get',
	            success: function(resp) {
	                // $('#captcha').empty();
	                $('#captcha').html(resp.data);
	            },
	            error(err) {
	                console.log(err);
	            }
	        })
	    });
	</script>
    <script>
		$(document).ready(function(){
		  // Add smooth scrolling to all links in navbar + footer link
		  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

		   // Make sure this.hash has a value before overriding default behavior
		  if (this.hash !== "") {

		    // Prevent default anchor click behavior
		    event.preventDefault();

		    // Store hash
		    var hash = this.hash;

		    // Using jQuery's animate() method to add smooth page scroll
		    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
		    $('html, body').animate({
		      scrollTop: $(hash).offset().top
		    }, 900, function(){

		      // Add hash (#) to URL when done scrolling (default click behavior)
		      window.location.hash = hash;
		      });
		    } // End if
		  });
		})
	</script>
</body>
</html>