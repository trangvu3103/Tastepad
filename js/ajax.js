$(document).ready(function($) {
	console.log("ajax file");

	$(".like-btn").on("click", function(event) {

		/* Act on the event */
		console.log('like');
		// $.ajax({
		//     url: 'ajax.php',
		//     type: 'POST',
		//     dataType:"json",
		//     data: {
		//     	like:1,
		//     	rid: $(this).data('rid'),
		//     },
		// 	async: false,
		// 	success: function(result){
		// 	    console.log(result);
		// 	    if (!result.err){
		// 		    $('div[data-rid="'+$(this).data('rid')+'"] .likeNum').text(result.mess)
		// 	    }
		// 	}
		// });
		
	});

	$(".dislike-btn").click(function(event) {
		/* Act on the event */
		console.log('dislike');
		// $.ajax({
		//     url: 'ajax.php',
		//     type: 'POST',
		//     dataType:"json",
		//     data: {
		//     	like:0,
		//     	rid: $(this).data('rid'),
		//     },
		// 	async: false,
		// 	success: function(result){
		// 	    console.log(result);
		// 	    if (!result.err){
		// 		    $('div[data-rid="'+$(this).data('rid')+'"] .likeNum').text(result.mess)
		// 	    }
		// 	}
		// });
		
	});
	//Login BTN
	$("#log-in-btn").click(function(event) {
		 // Act on the event 
		event.preventDefault();
		console.log('Login');
        $.ajax({
            url: 'login.php',
            type: 'POST',
            dataType:"json",
            data: {
            	email: $("#login-form [name='email']").val(),
            	password: $("#login-form [name='password']").val(),
            	login:1,
            },
        	success: function(data) {
        		console.log(data);
        		$('#login-form .err').text(data.mess);
        		if (!data.err) {
        			var path = location.pathname.split('/');
        			if (path[path.length-1].indexOf('.html')>-1) {
        			  path.length = path.length - 1;
        			}
        			var app = path[path.length-2]; // if you just want 'three'

        			console.log(data.sess);
        			var get = "?uid="+data.sess.uid+"&name="+data.sess.name+"&avartar="+data.sess.avartar+"&isLoggin="+data.sess.isLoggin+"&role="+data.sess.role;
        			window.location.href = '../'+app+"/home-page"+get;
        			// var app = path.join('/'); //  if you want the whole thing like '/one/two/three'

        		}else{
                	$('.err').text('');
                };
        	},    
        });
	});

	$("#sign-up-btn").click(function(event) {
		 // Act on the event 
		event.preventDefault();
		console.log('signup');
        $.ajax({
            url: 'login.php',
            type: 'POST',
            dataType:"json",
            data: {
            	email: $("#signup-form [name='email']").val(),
            	fullName: $("#signup-form [name='full-name']").val(),
            	password: $("#signup-form [name='pass']").val(),
            	rePassword: $("#signup-form [name='re-pass']").val(),
            	signup:1,
            },
        	success: function(data) {
        		console.log(data);
        		$('#signup-form .err').text(data.mess);
        		if (!data.err) {
        			var path = location.pathname.split('/');
        			if (path[path.length-1].indexOf('.html')>-1) {
        			  path.length = path.length - 1;
        			}
        			var app = path[path.length-2]; // if you just want 'three'
        			var get = "?uid="+data.sess.uid+"&name="+data.sess.name+"&avartar="+data.sess.avartar+"&isLoggin="+data.sess.isLoggin+"&role="+data.sess.role;
        			console.log( '../'+app+"/home-page");
        			window.location.href = '../'+app+"/home-page";
        			// window.location.href = "http://example.com/new_url";
        		}else{
                	$('.err').text('');
        		}
        	},    
        });
	});
	// var url = window.location.origin ? window.location.origin + '/Tastepad' : window.location.protocol + '/' + window.location.host + '/Tastepad';
 //    console.log( window.location.origin); 
 //    console.log(url); 
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
 //        //        // alert(data); // show data from the php script.
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