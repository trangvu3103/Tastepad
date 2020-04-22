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
        		$('#login-form .err').text(response.mess);
        		if (!response.err) {
        			var path = location.pathname.split('/');
        			if (path[path.length-1].indexOf('.html')>-1) {
        			  path.length = path.length - 1;
        			}
        			var app = path[path.length-2]; // if you just want 'three'
        			window.location.href = '../'+app+"/home-page";
        			// var app = path.join('/'); //  if you want the whole thing like '/one/two/three'

        		}
            	// if (response.err) {
             //    	$('.err').text('');
        	},    
        });
	});

	$("#sign-up-btn").click(function(event) {
		/* Act on the event */
		event.preventDefault();
        $.ajax({
            url: 'include/login.php',
            type: 'POST',
            dataType:"json",
            data: {
            	email: $("#signup-form [name='email']").val(),
            	fullName: $("#signup-form [name='full-name']").val(),
            	password: $("#signup-form [name='pass']").val(),
            	rePassword: $("#signup-form [name='re-pass']").val(),
            	signup:1,
            },
        	success: function(response) {
        		// console.log(response);
        		$('#signup-form .err').text(response.mess);
        		if (!response.err) {
        			var path = location.pathname.split('/');
        			if (path[path.length-1].indexOf('.html')>-1) {
        			  path.length = path.length - 1;
        			}
        			var app = path[path.length-2]; // if you just want 'three'
        			window.location.href = '../'+app+"/home-page";
        			// window.location.href = "http://example.com/new_url";
        		}
            	// if (response.err) {
             //    	$('.err').text('');
        	},    
        });
	});
	
});