$(document).ready(function($) {
	console.log("ajax file");

	//Login BTN
	$("#log-in-btn").click(function(event) {
		/* Act on the event */
		event.preventDefault();
        $.ajax({
            url: 'include/login.php',
            type: 'POST',
            dataType:"json",
            data: {
            	email: $("#login-form [name='email']").val(),
            	password: $("#login-form [name='password']").val(),
            	login:1,
            },
        	success: function(response) {
        		// console.log(response);
        		$('.err').text(response.mess);
            	// if (response.err) {
             //    	$('.err').text('');
        	},    
        });
	});
	
});