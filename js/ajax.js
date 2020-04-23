$(document).ready(function($) {
	console.log("ajax file");

	$(".like").click(function(event) {
		/* Act on the event */
		console.log('like');
		$.ajax({
		    url: 'ajax.php',
		    type: 'POST',
		    dataType:"json",
		    data: {
		    	rid: $(this).data('rid'),
		    },
			async: false,
			success: function(result){
			      console.log(result);
			    }
		});
		
	});
/*	//Login BTN
	$("#log-in-btn").click(function(event) {
		 // Act on the event 
		event.preventDefault();
		console.log('Login');
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
        		console.log(response);
        		alert(response);
        		$('#login-form .err').text(response.mess);
        		if (!response.err) {
        			var path = location.pathname.split('/');
        			if (path[path.length-1].indexOf('.html')>-1) {
        			  path.length = path.length - 1;
        			}
        			var app = path[path.length-2]; // if you just want 'three'

        			console.log(response.sess);
        			var get = "?uid="+response.sess.user_ID+"&name="+response.sess.user_name+"&avartar="+response.sess.avartar+"&isLoggin="+response.sess.isLoggin+"&role="+response.sess.role;
        			window.location.href = '../'+app+"/home-page"+get;
        			// var app = path.join('/'); //  if you want the whole thing like '/one/two/three'

        		}else{
                	$('.err').text('');
                };
        	},    
        });
	});*/
/*
	$("#sign-up-btn").click(function(event) {
		 Act on the event 
		event.preventDefault();
		console.log('signup');
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
        			console.log( '../'+app+"/home-page");
        			window.location.href = '../'+app+"/home-page";
        			// window.location.href = "http://example.com/new_url";
        		}else{
                	$('.err').text('');
        		}
        	},    
        });
	});
	var url = window.location.origin ? window.location.origin + '/Tastepad' : window.location.protocol + '/' + window.location.host + '/Tastepad';
    console.log( window.location.origin); 
    console.log(url); */
	// $('#addRecipe').on('submit', function(e){
 //        e.preventDefault();
 //        // var form = $(this);
 //        // var url = form.attr('action');
 //        // $.ajax({
 //        //    type: "POST",
 //        //    url: "include/addRecipe.php",
 //        //    data: form.serialize(), // serializes the form's elements.
 //        //    success: function(data)
 //        //    {
 //        //        // alert(data); // show response from the php script.
 //        //    }
 //        //  });
 //     //    $('#ifoftheform').ajaxForm(function(result) {
 //     //    // alert('the form was successfully processed');
 //    	// });
	// 	$.ajax({  
 //            url: url+"/include/addRecipe.php",  
 //            type:"POST",  
 //            data:new FormData(this),
 //            contentType:false,
 //            processData:false,
 //            success:function(data)  
 //            {
 //            	console.log(data);
 //            }  
 //           }); 
	// });

});