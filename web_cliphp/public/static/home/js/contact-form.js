  $(document).ready(function() {		
  $('#buttonsend').click( function() {
	
		var name    = $('#name').val();
		var subject = $('#subject').val();
		var email   = $('#email').val();
		var message = $('#message').val();
		
		$('.loading').fadeIn('fast');
		
		if (name != "" && subject != "" && email != "" && message != "")
			{

				$.ajax(
					{
						url: './sendemail.php',
						type: 'POST',
						data: "name=" + name + "&subject=" + subject + "&email=" + email + "&message=" + message,
						success: function(result) 
						{
							$('.loading').fadeOut('fast');
							if(result == "email_error") {
								$('#email').css({"background":"#FFFCFC","border":"1px solid #ffadad"}).next('.require').text(' !');
							} else {
								$('#name, #subject, #email, #message').val("");
								$('<div class="success-contact">Your message has been sent successfully. Thank you! </div>').insertBefore('#contact-form-area');
								$('.success-contact').fadeOut(5000, function(){ $(this).remove(); });
							}
						}
					}
				);
				return false;
				
			} 
		else 
			{
				$('.loading').fadeOut('fast');
				if( name == "") $('#name').css({"background":"#FFFCFC","border":"1px solid #ffadad"});
				if(subject == "") $('#subject').css({"background":"#FFFCFC","border":"1px solid #ffadad"});
				if(email == "" ) $('#email').css({"background":"#FFFCFC","border":"1px solid #ffadad"});
				if(message == "") $('#message').css({"background":"#FFFCFC","border":"1px solid #ffadad"});
				return false;
			}
	});
	
		$('#name, #subject, #email,#message').focus(function(){
			$(this).css({"border-color":"#d5d5d5","background":"-webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #EEEEEE), to(#FFFFFF))","background":"-moz-linear-gradient(top, #FFFFFF, #EEEEEE 1px, #FFFFFF 25px)"});
		});
      	
		});